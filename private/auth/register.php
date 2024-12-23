<?php
require_once '../../config/database.php';
require_once '../../config/mailer.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Ungültige E-Mail-Adresse');
  }
  if (strlen($password) < 8) {
    die('Passwort muss mindestens 8 Zeichen lang sein.');
  }

  $passwordHash = password_hash($password, PASSWORD_DEFAULT);
  $activationToken = bin2hex(random_bytes(32));

  $stmt = $pdo->prepare(
    "INSERT INTO users (username, email, password_hash, activation_token) 
         VALUES (:username, :email, :password_hash, :activation_token)"
  );
  $stmt->execute([
    ':username' => $username,
    ':email' => $email,
    ':password_hash' => $passwordHash,
    ':activation_token' => $activationToken,
  ]);

  $activationLink = "http://localhost:8888/private/auth/activate.php?token=$activationToken";
  sendActivationMail($email, $activationLink);

  echo "Registrierung erfolgreich. Überprüfe deine E-Mails.";
}
