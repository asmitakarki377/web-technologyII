<?php  
if (isset($_POST['submit'])){
$name=$_POST['name'];
$name=$_POST['phone'];
$name=$_POST['rollno'];

if (empty($phone)){
    echo "Phone number is Required!<br>";
}
elseif(!preg_match('[0-9]{10} $/', $phone)){
    echo"Invalid phone number! It should be 10 digits.<br>";
}
else{
    echo "Your Phone Number:".htmlspecialchars($phone)."<br>";
}
}

?>

<form method="post">

Name: <input type="text" name="name"><br><br>
Roll No: <input type="number" name="rollno"><br><br>
Phone Number: <input type="phone" name="phone"><br><br>
<input type="submit" name="submit" value="Submit">

</form>



