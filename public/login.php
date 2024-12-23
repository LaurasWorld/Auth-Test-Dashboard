<?php require_once '../templates/header.php'; ?>

<form method="POST" action="../private/auth/login.php">
  <input type="email" name="email" placeholder="E-Mail" required>
  <input type="password" name="password" placeholder="Passwort" required>
  <button type="submit">Einloggen</button>
</form>

<?php require_once '../templates/footer.php'; ?>