<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "virtuelni_ormar";

$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
    die("Greška pri povezivanju sa bazom: " . $connection->connect_error);
}
$connection->set_charset("utf8mb4");

?>
