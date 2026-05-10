<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/auth.php';

redirect_if_not_logged_in();

$message = '';
$error = '';
$user = get_logged_in_user($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = trim($_POST['description'] ?? '');
    
    try {
        $stmt = $pdo->prepare("UPDATE account SET description = ? WHERE id = ?");
        $stmt->execute([$description, $_SESSION['user_id']]);
        $message = "Profile updated successfully!";
        // Refresh user data
        $user['description'] = $description;
    } catch (PDOException $e) {
        $error = "Update failed: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings | SocialNet</title>
    <link rel="stylesheet" href="/socialnet/css/style.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="container">
        <div class="card">
            <h1>Settings</h1>
            <p style="color: var(--text-muted); margin-bottom: 2rem;">Edit your profile description.</p>

            <?php if ($message): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label>Profile Description</label>
                    <textarea name="description" rows="6" placeholder="Tell us something about yourself..."><?php echo htmlspecialchars($user['description'] ?? ''); ?></textarea>
                </div>
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>
</body>
</html>
