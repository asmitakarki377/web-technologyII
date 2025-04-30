<?php

include("databaseconn.php"); 

// Original static data insert example (commented out)
// $id = "2";
// $username = "aarush";
// $password = "12345";

// $sql = "INSERT INTO labwork(id, name, password) VALUES ('$id', '$username', '$password')";

// try {
//     mysqli_query($conn, $sql);
//     echo "Data insertion successful";
// } catch (mysqli_sql_exception $e) {
//     echo "Exception caught: " . $e->getMessage();
// }

?>

<html>
<form method="post">
ID: <input type="number" name="id"><br><br>
Name: <input type="text" name="username"><br><br>
Password: <input type="password" name="password"><br><br>
<input type="submit" name="submit" value="Submit">
</form>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username)) {
        echo "Please enter a username";
    } elseif (empty($password)) {
        echo "Please enter a password";
    } else {
      
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      
        $sql = "INSERT INTO labwork(id, name, password) VALUES ('$id', '$username', '$hashed_password')";

    
        if (mysqli_query($conn, $sql)) {
            echo "Data insertion successful";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        //
        /*
        try {
            mysqli_query($conn, $sql);
            echo "Data insertion successful";
        } catch (mysqli_sql_exception $e) {
            echo "Exception caught: " . $e->getMessage();
        }
        */
    }

    mysqli_close($conn);
}
?>
