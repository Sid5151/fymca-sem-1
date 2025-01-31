<?php

$username = "localhost";

$servername = "root";

$password = "";

$database = "fymcapro";

$conn = mysqli_connect($username, $servername, $password, $database);

if (!$conn) {

    die("Sorry Database not connected");
}
