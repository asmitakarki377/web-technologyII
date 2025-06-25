<?php
require 'config.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?: 0;
$stmt = pdo()->prepare('SELECT * FROM contacts WHERE id = ?');
$stmt->execute([$id]);
$c = $stmt->fetch();

if (!$c) { header('Location: index.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = 'UPDATE contacts SET firstname=?, designation=?, address1=?, address2=?,
            city=?, state=?, emailid=? WHERE id=?';
    $data = [
        $_POST['firstname'], $_POST['designation'], $_POST['address1'], $_POST['address2'],
        $_POST['city'], $_POST['state'], $_POST['emailid'], $id
    ];
    pdo()->prepare($sql)->execute($data);
    header('Location: index.php'); exit;
}

include 'header.php';
?>
<h2>Edit contact</h2>
<form method="post">
    <label>First&nbsp;name <input name="firstname" value="<?=htmlspecialchars($c['firstname'])?>" required></label><br>
    <label>Designation <input name="designation" value="<?=htmlspecialchars($c['designation'])?>" required></label><br>
    <label>Address 1 <input name="address1" value="<?=htmlspecialchars($c['address1'])?>" required></label><br>
    <label>Address 2 <input name="address2" value="<?=htmlspecialchars($c['address2'])?>"></label><br>
    <label>City <input name="city" value="<?=htmlspecialchars($c['city'])?>" required></label><br>
    <label>State <input name="state" value="<?=htmlspecialchars($c['state'])?>" required></label><br>
    <label>E-mail <input type="email" name="emailid" value="<?=htmlspecialchars($c['emailid'])?>" required></label><br><br>
    <button>Update</button>
</form>
<?php include 'footer.php'; ?>
