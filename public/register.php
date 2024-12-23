<?php require_once '../templates/header.php'; ?>

<form method="POST" action="../private/auth/register.php">
  <input type="text" name="username" placeholder="Benutzername" required>
  <input type="email" name="email" placeholder="E-Mail" required>
  <input type="password" name="password" placeholder="Passwort" required>
  <button type="submit">Registrieren</button>
</form>

<?php require_once '../templates/footer.php'; ?>