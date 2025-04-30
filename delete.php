<?php

include("databaseconn.php"); 

$id_deletion = "2";

$sql = "DELETE from labwork WHERE id='$id_deletion'";

try {
    mysqli_query($conn, $sql);
    echo "User deletion successful!!";
} catch (mysqli_sql_exception $e) {
    echo "Could not delete: " . $e->getMessage();
}

mysqli_close($conn);
?>
