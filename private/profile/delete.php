<?php
require_once '../../config/database.php';
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: ../../public/login.php');
  exit;
}

$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
$stmt->execute([':id' => $userId]);

session_destroy();
header('Location: ../../public/register.php');
exit;
