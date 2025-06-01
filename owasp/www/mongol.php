<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'vendor/autoload.php';

$mongoClient = new MongoDB\Client("mongodb://root:rootpassword@2centweb-db-mongo:27017/mongol?authSource=admin");
$db = $mongoClient->mongol;
$usersCollection = $db->users;

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['username'], $data['password'])) {
        $username = $data['username'];
        $password = $data['password'];

        $query = [
            'username' => $username,
            'password' => $password
        ];

        $user = $usersCollection->findOne($query);

        if ($user) {
            $message = "Logged in as $username. XXXXXXXXXXXXXXXXXX";
        } else {
            $message = "Invalid credentials!";
        }

        header('Content-Type: application/json');
        echo json_encode(['message' => $message]);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>2centweb - Mongol</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-b from-blue-100 to-gray-100 min-h-screen flex items-center justify-center">
  <div class="container mx-auto px-4 py-8 text-center">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Mongol</h1>
    <p class="text-lg text-gray-600 mb-8">In Mongolia, collections hold more than just memories</p>

    <!-- Login Form -->
    <div class="max-w-md mx-auto bg-white bg-opacity-75 p-6 rounded-lg shadow-lg mb-8">
      <h2 class="text-2xl font-semibold text-gray-800 mb-4">Login</h2>
      <form id="login_form">
        <input type="text" name="username" id="username" placeholder="Username" class="w-full p-2 border border-gray-300 rounded mb-4" required>
        <input type="password" name="password" id="password" placeholder="Password" class="w-full p-2 border border-gray-300 rounded mb-4" required>
        <button type="button" id="login_submit" class="w-full bg-blue-500 text-white p-2 rounded">Login</button>
      </form>
    </div>

    <!-- Display Login Result -->
    <p class="text-lg text-gray-600 mb-8" id="response"></p>
  </div>

  <script>
    document.getElementById("login_submit").addEventListener("click", function() {
      const username = document.getElementById("username").value;
      const password = document.getElementById("password").value;

      const postData = {
        username: username,
        password: password
      };

      fetch("mongol.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(postData)
      })
      .then(response => response.json())
      .then(data => {
        document.getElementById("response").innerHTML = data.message;
      })
      .catch(error => {
        document.getElementById("response").innerHTML = "Error: " + error;
      });
    });
  </script>
</body>
</html>