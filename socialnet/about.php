<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/auth.php';

// About page doesn't strictly require login based on many implementations, 
// but the prompt implies it has the MenuBar which is "common part of Home/Profile/Setting/About",
// and usually those are protected. I'll make it accessible but include navbar.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About | SocialNet</title>
    <link rel="stylesheet" href="/socialnet/css/style.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="container">
        <div class="card">
            <h1>About This Project</h1>
            <p style="margin-bottom: 2rem;">This application was developed as a part of the Computer Security course assignment.</p>
            
            <div style="background: var(--bg-dark); padding: 1.5rem; border-radius: 0.5rem; border: 1px solid var(--border-color);">
                <div style="margin-bottom: 1rem;">
                    <label style="margin-bottom: 0;">Student Name</label>
                    <div style="font-size: 1.25rem; font-weight: 600;">[Nguyen Thi Huong]</div>
                </div>
                <div>
                    <label style="margin-bottom: 0;">Student Number</label>
                    <div style="font-size: 1.25rem; font-weight: 600;">[1701786]</div>
                </div>
            </div>
            

            <p style="margin-top: 2rem; color: var(--text-muted); font-size: 0.875rem;">
                © 2026 SocialNet Mock Project. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
