<?php
require_once '../../config/database.php';
require_once '../permissions.php';
session_start();

checkPermission('admin'); // Nur Admins haben Zugriff

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $userId = $_POST['user_id'];
  $newRole = $_POST['role'];

  // Rolle des Benutzers aktualisieren
  $stmt = $pdo->prepare("UPDATE users SET role = :role WHERE id = :id");
  $stmt->execute([':role' => $newRole, ':id' => $userId]);

  header('Location: manage_permissions.php?success=1');
  exit;
}

// Liste aller Benutzer abrufen
$stmt = $pdo->query("SELECT id, username, role FROM users");
$users = $stmt->fetchAll();
?>

<h1>Berechtigungsmanagement</h1>
<?php if (isset($_GET['success'])): ?>
  <p style="color: green;">Die Berechtigung wurde erfolgreich aktualisiert!</p>
<?php endif; ?>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Benutzername</th>
      <th>Rolle</th>
      <th>Aktionen</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user): ?>
      <tr>
        <td><?= $user['id'] ?></td>
        <td><?= htmlspecialchars($user['username']) ?></td>
        <td><?= htmlspecialchars($user['role']) ?></td>
        <td>
          <form method="POST">
            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
            <select name="role">
              <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>Benutzer</option>
              <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
            <button type="submit">Speichern</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="../../public/dashboard.php">Zurück zum Dashboard</a>