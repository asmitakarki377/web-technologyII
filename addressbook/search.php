<?php
require 'config.php';

$email = filter_input(INPUT_GET, 'email', FILTER_VALIDATE_EMAIL);
if (!$email) { header('Location: index.php'); exit; }

$stmt = pdo()->prepare('SELECT * FROM contacts WHERE emailid = ?');
$stmt->execute([$email]);
$c = $stmt->fetch();

include 'header.php';
if (!$c) {
    echo "<p>No contact found for <strong>".htmlspecialchars($email)."</strong></p>";
} else {
    echo "<h2>Contact details</h2><ul>";
    foreach ($c as $k => $v) {
        if ($k === 'id') continue;
        echo "<li><strong>".ucfirst($k).":</strong> ".htmlspecialchars($v)."</li>";
    }
    echo "</ul>";
}
include 'footer.php';
