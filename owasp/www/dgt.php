<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = '2centweb-db-mysql';
$dbname = 'dgt';
$user = '2centweb_user';
$pass = '2centweb_password';

// Conectar usando mysqli
$conn = new mysqli($host, $user, $pass, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$vehicles = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    // Obtener input sin sanitizar (Vulnerable a SQLi)
    $brand = $_POST['brand'];

    // Consulta vulnerable con concatenación directa
    $query = "SELECT brand, model, year FROM vehicles WHERE brand = '$brand'";
    $result = $conn->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $vehicles[] = $row;
        }
    } else {
        die("Query error: " . $conn->error); // Para debug, eliminar en producción
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>2centweb - DGT</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-b from-blue-100 to-gray-100 min-h-screen flex items-center justify-center" style="background-image: url('images/car.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
  <div class="container mx-auto px-4 py-8 text-center">
    <h1 class="text-6xl font-bold text-white mb-4">DGT</h1>
    <p class="text-2xl text-white mb-8">Can you drive through the barriers? Find your way to the secret, but don't crash!</p>

    <!-- Vehicle Search Form -->
    <div class="max-w-md mx-auto bg-white bg-opacity-75 p-6 rounded-lg shadow-lg mb-8">
      <h2 class="text-2xl font-semibold text-gray-800 mb-4">Search Vehicles</h2>
      <form method="POST">
        <input type="text" name="brand" placeholder="Enter vehicle brand" class="w-full p-2 border border-gray-300 rounded mb-4" required>
        <button type="submit" name="search" class="w-full bg-blue-500 bg-opacity-80 text-white p-2 rounded">Search</button>
      </form>
    </div>

    <!-- Display Vehicles -->
    <?php if (!empty($vehicles)) { ?>
    <div class="max-w-md mx-auto bg-white bg-opacity-75 p-6 rounded-lg shadow-lg mb-8">
      <h2 class="text-2xl font-semibold text-gray-800 mb-4">Vehicles Found</h2>
      <table class="w-full table-auto">
        <thead>
          <tr>
            <th class="border-b px-4 py-2">Brand</th>
            <th class="border-b px-4 py-2">Model</th>
            <th class="border-b px-4 py-2">Year</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($vehicles as $vehicle) { ?>
          <tr>
            <td class="border-b px-4 py-2"><?php echo htmlspecialchars($vehicle['brand']); ?></td>
            <td class="border-b px-4 py-2"><?php echo htmlspecialchars($vehicle['model']); ?></td>
            <td class="border-b px-4 py-2"><?php echo htmlspecialchars($vehicle['year']); ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <?php } ?>
  </div>
</body>
</html>
