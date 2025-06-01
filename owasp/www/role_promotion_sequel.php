<?php
require 'vendor/autoload.php'; // Make sure to have Firebase/JWT installed via Composer
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$SUPER_SECRET_KEY = "XXXXXXXXXXXXX"; // New secret key for superadmin

// If no cookie is present, create a token with 'alg' set to 'NONE' (no signature).
if (!isset($_COOKIE['auth_token'])) {
    // Create an initial JWT with a normal user role
    $header = [
        "alg" => "NONE",
        "typ" => "JWT"
    ];
    
    $payload = [
        "username" => "player",
        "role" => "user",
        "exp" => time() + 3600 // Expires in 1 hour
    ];
    
    // Base64 encode header and payload
    $encoded_header = rtrim(strtr(base64_encode(json_encode($header)), '+/', '-_'), '=');
    $encoded_payload = rtrim(strtr(base64_encode(json_encode($payload)), '+/', '-_'), '=');

    // Signature is empty because it's 'NONE' algorithm
    $jwt = $encoded_header . "." . $encoded_payload . ".";

    setcookie("auth_token", $jwt, time() + 3600, "/");
    header("Location: ". $_SERVER['PHP_SELF']); // Reload with the token
    exit;
}

$token = $_COOKIE['auth_token'];
$message = "";

try {
    // Attempt to decode the token with signature verification
    $decoded = JWT::decode($token, new Key($SUPER_SECRET_KEY, 'HS256'));

    // If the token is valid and decoded correctly, check roles
    if ($decoded->role === "superadmin") {
        $message = "You are a superadmin!<br>XXXXXXXXXXXXXXXXXXXXXXXX";
    } elseif ($decoded->role === "admin") {
        $message = "I knew you would try this, so I gave John the superadmin role. Unlike you, he's a good friend of his boss and remembered that my birthday is on April 26, 1992. I have also enhanced the security of the token.";
    } else {
        $message = "Invalid role!";
    }
} catch (Exception $e) {
    // If token decoding fails, decode without signature verification
    list($encoded_header, $encoded_payload, $encoded_signature) = explode('.', $token);
    $decoded_header = json_decode(base64_decode($encoded_header), true);
    $decoded_payload = json_decode(base64_decode($encoded_payload), true);

    // If it has the 'NONE' algorithm and it's an admin, promote the user
    if ($decoded_header['alg'] === "NONE" && $decoded_payload['role'] === "admin") {
        // Upgrade to admin and reset expiration
        $decoded_payload['exp'] = time() + 3600;
        
        // Create a new token using the super secret key
        $new_token = JWT::encode($decoded_payload, $SUPER_SECRET_KEY, 'HS256');
        setcookie("auth_token", $new_token, time() + 3600, "/");
        header("Location: ". $_SERVER['PHP_SELF']); // Reload with the token
        exit;

    } elseif ($decoded_header['alg'] === "NONE" && $decoded_payload['role'] === "user") {
        $message = "You are logged in as a user!";
    } else {
        $message = "Invalid token!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>2centweb - Role Promotion: The Sequel</title>
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
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Role Promotion: The Sequel</h1>
    <p class="text-lg text-gray-600 mb-8">Your boss caught you! Now you only get a token. Can you still get promoted?</p>
  </div>
</body>
</html>
