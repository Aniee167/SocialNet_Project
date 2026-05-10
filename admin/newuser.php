<?php
require_once __DIR__ . '/../socialnet/includes/config.php';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $fullname = trim($_POST['fullname'] ?? '');
    $password = $_POST['password'] ?? '';
    $description = trim($_POST['description'] ?? '');

    if (empty($username) || empty($fullname) || empty($password)) {
        $error = "All fields except description are required.";
    } else {
        try {
            // Check if username already exists
            $check = $pdo->prepare("SELECT id FROM account WHERE username = ?");
            $check->execute([$username]);
            if ($check->fetch()) {
                $error = "Username already exists.";
            } else {
                // Securely hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                // Prepared statement to prevent SQL Injection
                $stmt = $pdo->prepare("INSERT INTO account (username, fullname, password, description) VALUES (?, ?, ?, ?)");
                $stmt->execute([$username, $fullname, $hashed_password, $description]);
                $message = "User created successfully!";
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - New User | SocialNet</title>
    <link rel="stylesheet" href="/socialnet/css/style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Create New User</h1>
            <p style="margin-bottom: 2rem; color: var(--text-muted);">Admin Panel to add users to the system.</p>

            <?php if ($message): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="fullname" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="4"></textarea>
                </div>
                <button type="submit">Add User</button>
            </form>
            <div style="margin-top: 1.5rem; text-align: center;">
                <a href="/socialnet/signin.php" style="color: var(--primary-color); text-decoration: none;">Go to Sign In</a>
            </div>
        </div>
    </div>
</body>
</html>
