<?php  
if (isset($_POST['submit'])){
$name=$_POST['name'];

if (empty($name)){
    echo "Name is Required!";
}
else{
    echo $name;
}
// if (isset($_POST['submit'])){ phone number validation
//     $name=$_POST['phone'];
    
//     if ([0]=9($name)){
//         echo "Name is Required!";
//     }
//     else{
//         echo $name;
//     }
}
?> 
<form method="post">

Name: <input type="text" name="name">
Roll No: <input type="number" name="rollno">
Phone Number: <input type="tel" name="phone">
<input type="submit" name="submit">

</form>



