<html>
<form method="post" action="" enctype="multipart/form-data">
Name: <input type="text" name="username"><br><br>
Uplaod File: <input type="file" name="fileupload"><br><br>
<input type="submit" name="submit" value="Submit">
</form>
</html>

<?php
// echo $_FILES['fileupload'];
// print_r ($_FILES['fileupload']);

$filenames = $_FILES['fileupload']['name'];
// $tempname = $_FILES['fileupload']['type'];
// $_FILES['fileupload']['size'];
$tempname = $_FILES['fileupload']['tmp_name'];

$target = "webs/";

// move_uploaded_file($tempname, $target.$filename);
move_uploaded_file($tempname, $target_dir.$filenames);

if (move_uploaded_file($tempname, $target_dir.$filenames)){
    echo "File uploaded successfully";
}


?>