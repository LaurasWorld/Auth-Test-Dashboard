<?php
require_once '../../config/database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
  $stmt->execute([':email' => $email]);

  if ($user = $stmt->fetch()) {
    if (!password_verify($password, $user['password_hash'])) {
      die('Ungültige Anmeldedaten.');
    }

    if ($user['is_active'] === 0) {
      die('Account ist nicht aktiviert.');
    }

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    header('Location: ../../public/dashboard.php');
    exit;
  } else {
    die('Ungültige Anmeldedaten.');
  }
}
