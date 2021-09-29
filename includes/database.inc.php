<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$databaseName = "firstprojectdb";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $databaseName);

if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}
