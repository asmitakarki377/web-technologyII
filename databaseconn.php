<?php
$db_server="localhost";
$db_user="root";
$db_password="";
$db_name="phpclasswork";
$conn="";

$conn=mysqli_connect($db_server, $db_user, $db_password, $db_name);

if($conn){
    echo "You are connected.";
}
else{
    echo"No Connection";
}
?>
