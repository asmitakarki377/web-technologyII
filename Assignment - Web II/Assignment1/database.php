<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment1"; 

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
} catch (mysqli_sql_exception $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
