<?php

include("databaseconn.php"); 

$id="2";
$username = "aarush";
$password = "12345";

$sql = "INSERT INTO labwork(id,name, password) VALUES ('$id','$username', '$password')";

try {
    mysqli_query($conn, $sql);
    echo "Data insertion successful";
} catch (mysqli_sql_exception $e) {
    echo "Exception caught: " . $e->getMessage();
}

mysqli_close($conn);

?>
