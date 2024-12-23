<?php
try {
  $dsn = 'mysql:host=localhost;dbname=datenbankname;charset=utf8mb4';
  $username = 'username';
  $password = 'password';

  $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ];

  $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
  die('Datenbankverbindung fehlgeschlagen: ' . $e->getMessage());
}