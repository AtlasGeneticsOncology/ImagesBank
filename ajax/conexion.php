<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'db_atlas';

$connection=new mysqli($hostname, $username, $password, $database);


if (!$connection) {
    die("La conexión ha fallado: " . mysqli_connect_error());
}
