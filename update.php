<?php

include("databaseconn.php"); 

$new_id = "20";
$new_username = "SANZU";
$new_password = "123456789";

$sql = "UPDATE labwork 
SET name='$new_username', password='$new_password' WHERE id='1'";

try {
    mysqli_query($conn, $sql);
    echo "<br><br>Username and Password updated successful!!";
} catch (mysqli_sql_exception $e) {
    echo "Exception caught: " . $e->getMessage();
}

mysqli_close($conn);
?>