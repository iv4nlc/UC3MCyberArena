<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// Enable external entity loading for XXE vulnerability
libxml_disable_entity_loader(false);

// Get the XML data from the request body
$xmlfile = file_get_contents('php://input');

// Load XML and enable entity loading (to make XXE attacks possible)
$dom = new DOMDocument();
$dom->loadXML($xmlfile, LIBXML_NOENT | LIBXML_DTDLOAD);

// Convert the DOM document to SimpleXML
$info = simplexml_import_dom($dom);

// Extract the user data from the XML
$name = $info->name;
$tel = $info->tel;
$email = $info->email;
$password = $info->password;

echo "Sorry, $email is already registered!";
?>
