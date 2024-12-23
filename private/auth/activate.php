<?php
require_once '../../config/database.php';

if (isset($_GET['token'])) {
  $token = $_GET['token'];

  $stmt = $pdo->prepare("SELECT id FROM users WHERE activation_token = :token");
  $stmt->execute([':token' => $token]);

  if ($user = $stmt->fetch()) {
    $stmt = $pdo->prepare(
      "UPDATE users SET is_active = 1, activation_token = NULL WHERE id = :id"
    );
    $stmt->execute([':id' => $user['id']]);
    echo "Dein Account wurde erfolgreich aktiviert!";
  } else {
    echo "Ungültiger Aktivierungstoken!";
  }
}
