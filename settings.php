<?php
include 'db.php';

// Fetch current settings
$settings = $conn->query("SELECT * FROM settings LIMIT 1")->fetch_assoc();

// Handle form update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $consumer_key    = $_POST['consumer_key'];
    $consumer_secret = $_POST['consumer_secret'];
    $shortcode       = $_POST['shortcode'];
    $passkey         = $_POST['passkey'];
    $callback_url    = $_POST['callback_url'];
    $theme_color     = $_POST['theme_color'];

    $sql = "UPDATE settings SET consumer_key=?, consumer_secret=?, shortcode=?, passkey=?, callback_url=?, theme_color=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $consumer_key, $consumer_secret, $shortcode, $passkey, $callback_url, $theme_color, $settings['id']);
    
    if ($stmt->execute()) {
        $msg = "✅ Settings updated successfully!";
    } else {
        $msg = "❌ Error updating settings: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Settings</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
  <?php include 'sidebar.php'; ?>
  <div class="container-fluid p-4" style="margin-left:220px;">
    <h2 class="mb-4">⚙️ Application Settings</h2>
    
    <?php if (isset($msg)): ?>
      <div class="alert alert-info"><?= $msg ?></div>
    <?php endif; ?>

    <form method="POST" class="card p-4 shadow">
      <div class="mb-3">
        <label class="form-label">Consumer Key</label>
        <input type="text" name="consumer_key" class="form-control" value="<?= $settings['consumer_key'] ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Consumer Secret</label>
        <input type="text" name="consumer_secret" class="form-control" value="<?= $settings['consumer_secret'] ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Shortcode</label>
        <input type="text" name="shortcode" class="form-control" value="<?= $settings['shortcode'] ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Passkey</label>
        <textarea name="passkey" class="form-control" rows="2"><?= $settings['passkey'] ?></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Callback URL</label>
        <input type="url" name="callback_url" class="form-control" value="<?= $settings['callback_url'] ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Theme Color</label>
        <input type="color" name="theme_color" class="form-control form-control-color" value="<?= $settings['theme_color'] ?>">
      </div>
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Settings</button>
    </form>
  </div>
</div>
</body>
</html>
