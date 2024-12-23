<?php
require_once '../../config/database.php';
require_once '../permissions.php';
session_start();

checkPermission('admin');

if (!isset($_GET['id'])) {
  die('Kein Benutzer ausgewählt.');
}

$userId = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
$stmt->execute([':id' => $userId]);

header('Location: manage_users.php');
exit;
