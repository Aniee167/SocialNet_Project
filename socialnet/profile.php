<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/auth.php';

redirect_if_not_logged_in();

$owner_username = $_GET['owner'] ?? null;
$profile_user = null;

if ($owner_username) {
    // Show specific user's profile
    $stmt = $pdo->prepare("SELECT username, fullname, description FROM account WHERE username = ?");
    $stmt->execute([$owner_username]);
    $profile_user = $stmt->fetch();
} else {
    // Show logged in user's profile
    $profile_user = get_logged_in_user($pdo);
}

if (!$profile_user) {
    $error = "User not found.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $profile_user ? htmlspecialchars($profile_user['fullname']) : 'User Not Found'; ?> | Profile</title>
    <link rel="stylesheet" href="/socialnet/css/style.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="container">
        <?php if ($profile_user): ?>
            <div class="card">
                <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem;">
                    <div style="width: 80px; height: 80px; background: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: bold;">
                        <?php echo strtoupper(substr($profile_user['fullname'], 0, 1)); ?>
                    </div>
                    <div>
                        <h1 style="margin-bottom: 0.25rem;"><?php echo htmlspecialchars($profile_user['fullname']); ?></h1>
                        <p style="color: var(--text-muted);">@<?php echo htmlspecialchars($profile_user['username']); ?></p>
                    </div>
                </div>

                <div style="border-top: 1px solid var(--border-color); padding-top: 1.5rem;">
                    <h3 style="font-size: 0.875rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.75rem;">About</h3>
                    <div style="white-space: pre-wrap; font-size: 1.125rem;">
                        <?php echo !empty($profile_user['description']) ? htmlspecialchars($profile_user['description']) : '<em>No description provided.</em>'; ?>
                    </div>
                </div>
                
                <?php if ($profile_user['username'] === get_logged_in_user($pdo)['username']): ?>
                    <div style="margin-top: 2rem;">
                        <a href="/socialnet/setting.php" class="logo" style="font-size: 0.875rem; border: 1px solid var(--primary-color); padding: 0.5rem 1rem; border-radius: 0.5rem;">Edit My Profile</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="card">
                <h1>User Not Found</h1>
                <p>The profile you are looking for does not exist.</p>
                <a href="/socialnet/index.php" style="color: var(--primary-color); text-decoration: none; margin-top: 1rem; display: inline-block;">Back to Home</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
