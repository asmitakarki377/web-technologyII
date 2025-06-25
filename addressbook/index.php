<?php
require 'config.php';
$stmt = pdo()->query('SELECT * FROM contacts ORDER BY firstname');
$all  = $stmt->fetchAll();
include 'header.php';
?>
<form action="search.php" method="get">
    Search by e-mail: <input name="email" type="email" required>
    <button>Search</button>
</form>

<h2>All contacts (<?=count($all)?>)</h2>
<table>
<thead><tr>
 <th>Name</th><th>Designation</th><th>City</th><th>State</th><th>E-mail</th><th>Actions</th>
</tr></thead><tbody>
<?php foreach ($all as $c): ?>
<tr>
 <td><?=htmlspecialchars($c['firstname'])?></td>
 <td><?=htmlspecialchars($c['designation'])?></td>
 <td><?=htmlspecialchars($c['city'])?></td>
 <td><?=htmlspecialchars($c['state'])?></td>
 <td><?=htmlspecialchars($c['emailid'])?></td>
 <td>
     <a href="edit.php?id=<?=$c['id']?>">edit</a> |
     <a href="delete.php?id=<?=$c['id']?>"
        onclick="return confirm('Delete this contact?')">delete</a>
 </td>
</tr>
<?php endforeach; ?>
</tbody></table>
<?php include 'footer.php'; ?>
