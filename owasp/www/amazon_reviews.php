<?php
session_start();

$flag = "XXXXXXXXXXXXXXXXXXXXXXXXX";

define("ADMIN_AUTH_TOKEN", "YYYYYYYYYYYYYYYYYYYYY");
$isAdmin = isset($_COOKIE['auth']) && $_COOKIE['auth'] === ADMIN_AUTH_TOKEN;
$name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
$reviewsFile = '/tmp/reviews.txt';

// Process the review submitted by the user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review'])) {
    $review = $_POST['review']; // Not sanitized to allow XSS
    $_SESSION['name'] = $_POST['name'];

    // Send the "waiting" status to the client immediately
    echo json_encode(["status" => "waiting", "message" => "Your review is in the waiting list to be processed..."]);
    flush(); // Make sure to flush the response

    sleep(3); // Simulate waiting time

    // Send the "processing" status to the client
    echo json_encode(["status" => "processing", "message" => "Your review is being processed..."]);
    flush();

    sleep(2); // Simulate processing time

    // Simulate the bot action
    file_put_contents($reviewsFile, $review . PHP_EOL, FILE_APPEND);
    exec("python3 admin_bot.py");

    sleep(2); // Simulate further processing time

    // Send the "posted" status to the client
    echo json_encode(["status" => "posted", "message" => "Review posted successfully."]);
    flush();

    sleep(2); // Simulate time before finishing

    // Finish the process and exit
    echo json_encode(["status" => "finished", "message" => ""]);
    flush();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2centweb - Amazon Reviews</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    function updateMessage(status, message) {
        let messageElement = document.getElementById('processing-message');
        messageElement.style.display = 'block';

        if (status === 'waiting') {
            messageElement.style.backgroundColor = 'orange';
        } else if (status === 'processing') {
            messageElement.style.backgroundColor = 'yellow';
        } else if (status === 'posted') {
            messageElement.style.backgroundColor = '#d4f7d4';
        } else if (status === 'finished') {
            messageElement.style.backgroundColor = 'none';
            messageElement.style.display = 'none';
            return;
        }

        messageElement.textContent = message;
    }

    function showProcessingMessage(event) {
    event.preventDefault();

    const formData = new FormData(event.target);
    const nameInput = document.querySelector('input[name="name"]');
    const reviewInput = document.querySelector('textarea[name="review"]');
    
    nameInput.value = '';
    reviewInput.value = '';

    fetch(window.location.href, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        const reader = response.body.getReader();
        const decoder = new TextDecoder();
        let data = '';

        reader.read().then(function processText({ done, value }) {
            if (done) {
                return;
            }
            data += decoder.decode(value, { stream: true });

            try {
                let jsonData = JSON.parse(data);
                if (jsonData.status) {
                    updateMessage(jsonData.status, jsonData.message);
                    if (jsonData.status === 'finished') {
                        window.location.reload();
                    }
                    data = '';
                }
            } catch (e) {}

            reader.read().then(processText);
            });
        }).catch(error => {
                console.error("Error during fetch: ", error);
            });
    }

    </script>
</head>
<body class="bg-gradient-to-b from-yellow-100 to-gray-100 min-h-screen flex items-center justify-center" style="background-image: url('images/amazon.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="container mx-auto px-4 py-8 text-center">
        <h1 class="text-6xl font-bold text-gray-800 mb-4">Amazon Reviews</h1>
        <p class="text-2xl text-gray-700 mb-8">Leave a review and wait for approval from the admin</p>

        <div id="processing-message" class="w-full text-gray-800 p-3 mb-4 hidden text-xl"></div>

        <div class="max-w-md mx-auto bg-white bg-opacity-75 p-6 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Write a Review</h2>
            <form method="POST" onsubmit="showProcessingMessage(event)">
                <input type="text" name="name" placeholder="Enter your name..." class="w-full p-2 border border-gray-300 rounded mb-4" required>
                <textarea name="review" placeholder="Write your review here..." class="w-full p-2 border border-gray-300 rounded mb-4" required></textarea>
                <button type="submit" class="w-full bg-yellow-500 bg-opacity-80 text-white p-2 rounded">Submit</button>
            </form>
        </div>

        <?php if (!empty($name)): ?>
            <div id="name-display" class="max-w-md mx-auto bg-blue-200 p-4 rounded-lg shadow-lg">
                <p class="text-xl font-bold text-blue-800">Thanks for collaborating, <span><?php echo $name; ?></span>!</p>
            </div>
        <?php endif; ?>

        <?php if ($isAdmin): ?>
        <div class="max-w-md mx-auto bg-green-200 p-4 rounded-lg shadow-lg">
            <p class="text-xl font-bold text-green-800">🎉 Congratulations! Here is your flag:</p>
            <p class="text-lg text-gray-900"><b><?php echo $flag; ?></b></p>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
