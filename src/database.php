<?php
use MyApp\classes\products;

$server = "localhost";
$username = "root";
$password = "";
$db_name = "scandiweb_task";

$database = new mysqli($server, $username, $password, $db_name);

if ($database->connect_error) {
  die("Connection failed: " . $database->connect_error);
}

products::setDatabase($database);

?>