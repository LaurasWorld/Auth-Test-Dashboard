<?php
require_once '../private/permissions.php';
require_once '../templates/header.php';
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

checkPermission('admin'); // Zugriff nur für Admins
?>

<h1>Admin-Dashboard</h1>
<p>Willkommen, Admin!</p>

<!-- Benutzerverwaltung -->
<h2>Benutzerverwaltung</h2>
<a href="../private/users/manage_users.php">Alle Benutzer anzeigen</a>

<!-- Berechtigungsmanagement -->
<h2>Berechtigungsmanagement</h2>
<a href="../private/users/manage_permissions.php">Rollen und Berechtigungen verwalten</a>

<!-- Profilverwaltung -->
<h2>Profil</h2>
<a href="profile.php">Profil anzeigen und bearbeiten</a>

<a href="../public/logout.php">Abmelden</a>

<?php require_once '../templates/footer.php'; ?>