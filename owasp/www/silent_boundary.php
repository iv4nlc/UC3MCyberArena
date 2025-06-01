<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'xxxxxxxxxxxxx'; // Docker service name
$dbname = 'xxxxxxxxxxxxxx';
$user = 'xxxxxxxxxxxxxx';
$pass = 'xxxxxxxxxxxxxx';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection error: " . $e->getMessage());
}

$message = ''; // Variable to store the message

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username exists in the database before truncating
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $userExists = $stmt->fetchColumn();

    if ($userExists) {
        $message = "Username already exists.";

    } else if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) { 
        // Password validation: minimum 8 characters, one uppercase letter, one lowercase letter, one number, and one special symbol
        $message = "Password must be at least 8 characters long and include an uppercase letter, a lowercase letter, a number, and a special character.";

    } else if (strpos($username, 'admin') === 0) { // Only allow usernames starting with "admin" in order to not fill the database with unnecessary data
        $username = substr($_POST['username'], 0, 5); // Simulating truncation (similar to setting sql_mode = 'NO_ENGINE_SUBSTITUTION')  
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Try to insert, and if it already exists, update the password
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)
                               ON DUPLICATE KEY UPDATE password = VALUES(password)");
        $stmt->execute(['username' => $username, 'password' => $hashed_password]);

        $message = "Registration successful";
    } else {
        $message = "The user must be validated before registration can proceed.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = substr($_POST['username'], 0, 5); // Force truncation to 5 characters
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT password FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $hashed_password = $stmt->fetchColumn();
    
    if ($hashed_password && password_verify($password, $hashed_password)) {
        if ($username === 'admin') {
            $message = "Welcome admin.<br>xxxxxxxxxxxxxxxxxxxxxxxx";
        } else {
            $message = "Login successful, but you are not admin.";
        }
    } else {
        $message = "Incorrect username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>2centweb - Silent Boundary</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script>
    // Check if a message is set and show it in an alert box
    <?php if (!empty($message)) {
      $message = str_replace("<br>", '\n', $message);
    ?>
      alert("<?php echo $message; ?>");
    <?php } ?>
  </script>
</head>
<body class="bg-gradient-to-b from-blue-100 to-gray-100 min-h-screen flex items-center justify-center">
  <div class="container mx-auto px-4 py-8 text-center">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Silent Boundary</h1>
    <p class="text-lg text-gray-600 mb-8">The truth is held by one. Only the admin can reveal the way</p>

    <!-- Registration Form -->
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg mb-8">
      <h2 class="text-2xl font-semibold text-gray-800 mb-4">Register</h2>
      <form method="POST">
        <input type="text" name="username" maxlength="5" placeholder="Username" class="w-full p-2 border border-gray-300 rounded mb-4" required>
        <input type="password" name="password" placeholder="Password" class="w-full p-2 border border-gray-300 rounded mb-4" required>
        <button type="submit" name="register" class="w-full bg-blue-500 text-white p-2 rounded">Register</button>
      </form>
    </div>

    <!-- Login Form -->
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
      <h2 class="text-2xl font-semibold text-gray-800 mb-4">Login</h2>
      <form method="POST">
        <input type="text" name="username" placeholder="Username" class="w-full p-2 border border-gray-300 rounded mb-4" required>
        <input type="password" name="password" placeholder="Password" class="w-full p-2 border border-gray-300 rounded mb-4" required>
        <button type="submit" name="login" class="w-full bg-green-500 text-white p-2 rounded">Login</button>
      </form>
    </div>
  </div>
</body>
</html>
