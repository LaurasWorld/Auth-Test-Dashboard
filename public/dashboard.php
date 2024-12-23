<?php
require_once '../private/permissions.php';
require_once '../templates/header.php';
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

if ($_SESSION['role'] === 'admin') {
  header('Location: ../private/dashboard.php'); // Weiterleitung für Admins
  exit;
}
?>

<h1>User-Dashboard</h1>
<p>Willkommen, Benutzer!</p>

<h2>Profilverwaltung</h2>
<a href="profile.php">Profil anzeigen und bearbeiten</a>

<a href="logout.php">Abmelden</a>

<?php require_once '../templates/footer.php'; ?>