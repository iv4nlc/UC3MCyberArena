<?php
  $USER = "admin";
  $PASSWORD = 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXX';
  $message = '';

  if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($_POST['username'] === $USER) {
      if (strcmp($_POST['password'], $PASSWORD) == 0) {
        $message = "Access granted, welcome admin user.<br>XXXXXXXXXXXXXXXXXXXXXXXXXXX";
      } else {
        $message = "The provided password is invalid";
      }
    } else {
      $message = "The entered username does not exist";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>2centweb - Juggling</title>
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
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Juggling</h1>
    <p class="text-lg text-gray-600 mb-8">It’s all about balance—types are in motion, but can you catch the right one at the right time?</p>
    
    <!-- Login Form -->
    <form method="POST" action="" class="flex flex-col items-center">
      <label for="username" class="text-lg text-gray-600 mb-2">Username:</label>
      <input type="text" name="username" id="username" size="30" class="px-4 py-2 mb-4 border border-gray-300 rounded-md">
      
      <label for="password" class="text-lg text-gray-600 mb-2">Password:</label>
      <input type="password" name="password" id="password" size="30" class="px-4 py-2 mb-4 border border-gray-300 rounded-md">
      
      <input type="submit" value="Login" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
    </form>

    <hr class="mt-6">
  </div>
</body>
</html>
