<?php
require_once '../../config/database.php';
require_once '../permissions.php';
session_start();

checkPermission('admin');

$stmt = $pdo->query("SELECT id, username, email, role, is_active FROM users");
$users = $stmt->fetchAll();
?>

<h1>Benutzerverwaltung</h1>
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Benutzername</th>
      <th>E-Mail</th>
      <th>Rolle</th>
      <th>Aktiviert</th>
      <th>Aktionen</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user): ?>
      <tr>
        <td><?= $user['id'] ?></td>
        <td><?= htmlspecialchars($user['username']) ?></td>
        <td><?= htmlspecialchars($user['email']) ?></td>
        <td><?= htmlspecialchars($user['role']) ?></td>
        <td><?= $user['is_active'] ? 'Ja' : 'Nein' ?></td>
        <td>
          <a href="edit_user.php?id=<?= $user['id'] ?>">Bearbeiten</a>
          <a href="delete_user.php?id=<?= $user['id'] ?>" onclick="return confirm('Benutzer wirklich löschen?')">Löschen</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="../../public/dashboard.php">Zurück zum Dashboard</a>