<?php
require_once '../config/database.php';
require_once '../templates/header.php';
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $bio = $_POST['bio'];
  $profilePicture = null;

  if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../data/uploads/';
    $profilePicture = $uploadDir . basename($_FILES['profile_picture']['name']);
    move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profilePicture);
  }

  $stmt = $pdo->prepare(
    "INSERT INTO profiles (user_id, bio, profile_picture) 
         VALUES (:user_id, :bio, :profile_picture)
         ON DUPLICATE KEY UPDATE bio = :bio, profile_picture = :profile_picture"
  );
  $stmt->execute([
    ':user_id' => $userId,
    ':bio' => $bio,
    ':profile_picture' => $profilePicture,
  ]);
}

$stmt = $pdo->prepare("SELECT * FROM profiles WHERE user_id = :user_id");
$stmt->execute([':user_id' => $userId]);
$profile = $stmt->fetch();
?>

<h1>Profil bearbeiten</h1>
<form method="POST" enctype="multipart/form-data">
  <label>Biografie:</label>
  <textarea name="bio"><?= htmlspecialchars($profile['bio'] ?? '') ?></textarea>

  <label>Profilbild:</label>
  <input type="file" name="profile_picture">

  <button type="submit">Speichern</button>
</form>

<?php if ($profile && $profile['profile_picture']): ?>
  <img src="<?= $profile['profile_picture'] ?>" alt="Profilbild">
<?php endif; ?>

<form method="POST" action="../private/profile/delete.php">
  <button type="submit" onclick="return confirm('Profil wirklich löschen?')">Profil löschen</button>
</form>

<a href="dashboard.php">Zurück zum Dashboard</a>