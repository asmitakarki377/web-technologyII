<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = 'INSERT INTO contacts
            (firstname, designation, address1, address2, city, state, emailid)
            VALUES (?,?,?,?,?,?,?)';
    $data = [
        $_POST['firstname'], $_POST['designation'], $_POST['address1'],
        $_POST['address2'], $_POST['city'], $_POST['state'], $_POST['emailid']
    ];
    pdo()->prepare($sql)->execute($data);
    header('Location: index.php'); exit;
}
include 'header.php';
?>
<h2>Add contact</h2>
<form method="post">
    <label>First&nbsp;name <input name="firstname" required></label><br>
    <label>Designation <input name="designation" required></label><br>
    <label>Address 1 <input name="address1" required></label><br>
    <label>Address 2 <input name="address2"></label><br>
    <label>City <input name="city" required></label><br>
    <label>State <input name="state" required></label><br>
    <label>E-mail <input type="email" name="emailid" required></label><br><br>
    <button>Save</button>
</form>
<?php include 'footer.php'; ?>
