<?php
include 'db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {
    $stmt = $conn->prepare("INSERT INTO address_book (firstname, designation, address1, address2, city, state, emailid) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", 
        $_POST['firstname'], 
        $_POST['designation'], 
        $_POST['address1'], 
        $_POST['address2'], 
        $_POST['city'], 
        $_POST['state'], 
        $_POST['emailid']
    );

    if ($stmt->execute()) {
        echo "New record added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Add Address</title></head>
<body>
<h2>Add New Address</h2>
<form method="POST">
    First Name: <input type="text" name="firstname" required><br><br>
    Designation: <input type="text" name="designation"><br><br>
    Address1: <input type="text" name="address1"><br><br>
    Address2: <input type="text" name="address2"><br><br>
    City: <input type="text" name="city"><br><br>
    State: <input type="text" name="state"><br><br>
    Email ID: <input type="email" name="emailid" required><br><br>
    <input type="submit" name="submit" value="Add">
</form>
</body>
</html>
