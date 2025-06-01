<?php
session_start();

if ($_SERVER['REMOTE_ADDR'] != "127.0.0.1") {
    http_response_code(403);
    die("Access denied");
}

setcookie("auth", "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX", time() + 3600, "/", false, false);
$reviewsFile = "/tmp/reviews.txt";

if (file_exists($reviewsFile)) {
    $reviews = file_get_contents($reviewsFile);
    echo $reviews;
} else {
    echo "No reviews found";
}

session_destroy();
?>