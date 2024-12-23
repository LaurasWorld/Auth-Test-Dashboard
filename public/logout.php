<?php
session_start();

// Zerstört alle Sitzungscookies und -daten
$_SESSION = []; // Leert das Session-Array

if (ini_get("session.use_cookies")) {
  $params = session_get_cookie_params();
  setcookie(
    session_name(),
    '',
    time() - 42000,
    $params["path"],
    $params["domain"],
    $params["secure"],
    $params["httponly"]
  );
}

// Beendet die Session
session_destroy();

// Leitet den Benutzer zurück zur Login-Seite
header('Location: login.php');
exit;
