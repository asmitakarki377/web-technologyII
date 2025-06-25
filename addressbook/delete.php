<?php
require 'config.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id) {
    pdo()->prepare('DELETE FROM contacts WHERE id = ?')->execute([$id]);
}
header('Location: index.php');
