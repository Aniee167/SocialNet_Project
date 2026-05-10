<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/auth.php';

redirect_if_not_logged_in();

$user = get_logged_in_user($pdo);

// Get list of other users
try {
    $stmt = $pdo->prepare("SELECT username, fullname FROM account WHERE id != ?");
    $stmt->execute([$_SESSION['user_id']]);
    $other_users = $stmt->fetchAll();
} catch (PDOException $e) {
    $other_users = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home | SocialNet</title>
    <link rel="stylesheet" href="/socialnet/css/style.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <div class="container">
        <div class="card">
            <h1>Hello, <?php echo htmlspecialchars($user['fullname']); ?>!</h1>
            <p style="color: var(--text-muted);">Logged in as: <strong>@<?php echo htmlspecialchars($user['username']); ?></strong></p>
        </div>

        <div class="card">
            <h2>Other Users</h2>
            <?php if (empty($other_users)): ?>
                <p style="color: var(--text-muted);">No other users in the system.</p>
            <?php else: ?>
                <ul class="user-list">
                    <?php foreach ($other_users as $other): ?>
                        <li class="user-item">
                            <div>
                                <strong><?php echo htmlspecialchars($other['fullname']); ?></strong>
                                <br>
                                <span style="color: var(--text-muted); font-size: 0.875rem;">@<?php echo htmlspecialchars($other['username']); ?></span>
                            </div>
                            <a href="/socialnet/profile.php?owner=<?php echo urlencode($other['username']); ?>">View Profile</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
