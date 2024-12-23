<?php
require_once '../../config/database.php';
require_once '../permissions.php';
session_start();

checkPermission('admin');

if (!isset($_GET['id'])) {
  die('Kein Benutzer ausgewählt.');
}

$userId = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $role = $_POST['role'];
  $isActive = isset($_POST['is_active']) ? 1 : 0;

  $stmt = $pdo->prepare("UPDATE users SET role = :role, is_active = :is_active WHERE id = :id");
  $stmt->execute([
    ':role' => $role,
    ':is_active' => $isActive,
    ':id' => $userId,
  ]);

  header('Location: manage_users.php');
  exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute([':id' => $userId]);
$user = $stmt->fetch();

if (!$user) {
  die('Benutzer nicht gefunden.');
}
?>

<h1>Benutzer bearbeiten</h1>
<form method="POST">
  <label>Rolle:</label>
  <select name="role">
    <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>Benutzer</option>
    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
  </select>

  <label>Aktiviert:</label>
  <input type="checkbox" name="is_active" <?= $user['is_active'] ? 'checked' : '' ?>>

  <button type="submit">Speichern</button>
</form>

<a href="manage_users.php">Zurück</a>