<?php
class User {
    public $username;
    public $password;
    public $role = "user"; // By default, all users are regular users

    public function __construct($data) {
        foreach ($data as $key => $value) {
            $this->$key = $value; // Unrestricted mass assignment
        }
    }
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User($_POST);

    if ($user->role === "admin") {
        $message = "Access granted!<br>XXXXXXXXXXXXXXXXXXX";
    } else {
        $message = "Welcome, " . htmlspecialchars($user->username) . "! You are logged in as a regular user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>2centweb - Role Promotion</title>
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
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Role Promotion</h1>
    <p class="text-lg text-gray-600 mb-8">Some doors remain closed—unless you have the right keys.</p>

    <form method="POST" class="flex flex-col items-center">
      <label for="username" class="text-lg text-gray-600 mb-2">Username:</label>
      <input type="text" name="username" required class="px-4 py-2 mb-4 border border-gray-300 rounded-md">

      <label for="password" class="text-lg text-gray-600 mb-2">Password:</label>
      <input type="password" name="password" required class="px-4 py-2 mb-4 border border-gray-300 rounded-md">

      <input type="submit" value="Register" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
    </form>
  </div>
</body>
</html>
