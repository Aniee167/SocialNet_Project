# SocialNet Project

A mock social network application built for a Computer Security course.

## Tech Stack
- **OS**: Linux
- **Web Server**: Nginx (or Apache)
- **Database**: MySQL / MariaDB
- **Backend**: PHP 8.x

## Features
- **Admin Panel**: `/admin/newuser.php` to create users.
- **Secure Authentication**: Password hashing with `password_hash()` and session-based auth.
- **Protection**: Prepared statements used for all database queries to prevent SQL Injection.
- **Premium UI**: Modern dark-themed responsive design using CSS.
- **Profile Management**: Users can edit their own descriptions.
- **User Discovery**: List of all users with links to their profiles.

## Setup Instructions

### 1. Database Creation
Import the `db.sql` file into your MySQL/MariaDB server:
```bash
mysql -u your_user -p < db.sql
```

### 2. Configuration
Edit `socialnet/includes/config.php` to match your database credentials:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_NAME', 'socialnet');
```

### 3. Web Server Configuration
Ensure your Nginx/Apache root points to the directory containing `socialnet` and `admin` folders.

#### Nginx Example:
```nginx
server {
    listen 80;
    server_name localhost;
    root /path/to/project;

    index index.php index.html;

    location / {
        try_files $uri $uri/ =404;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
    }
}
```

### 4. Usage
1. Go to `/admin/newuser.php` to create your first user.
2. Go to `/socialnet/signin.php` to log in.
3. Explore Home, Settings, and Profile pages.

## Extended Features
- **Modern UI**: Implemented a responsive dark-mode design with glassmorphism effects.
- **Input Sanitization**: Used `htmlspecialchars()` for output to prevent XSS (Cross-Site Scripting).
- **Secure Passwords**: Passwords are never stored in plain text.
