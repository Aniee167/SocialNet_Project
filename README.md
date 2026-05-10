# SocialNet Project

A social network web application project for Computer Security course.

## Tech Stack
- **OS**: Linux
- **Web Server**: Nginx
- **Database**: MySQL / MariaDB
- **Backend**: PHP 8.x

## Features
- **Admin Panel**: `http://localhost/admin/newuser.php` to create users.
- **Authentication**: Secure login and session management.
- **Security**: Prepared statements to prevent SQL Injection, password hashing, and HTML escaping for XSS protection.
- **UI**: Simple responsive UI using CSS.
- **Profile Management**: Users can edit their descriptions.

## Default Credentials (for testing)
- **Username**: `admin`
- **Password**: `admin123`

## Setup Instructions

1. **Import Database**:
   Import the `db.sql` file into your MySQL/MariaDB server:
   ```bash
   mysql -u root -p < db.sql
   ```

2. **Configure Database**:
   Edit `socialnet/includes/config.php` to match your database credentials:
   ```php
   define('DB_USER', 'your_username');
   define('DB_PASS', 'your_password');
   ```

3. **Deployment**:
   Place the project folders (`admin` and `socialnet`) in your Nginx root directory (e.g., `/var/www/html`).

4. **Access the App**:
   - Create User: `http://localhost/admin/newuser.php`
   - Sign In: `http://localhost/socialnet/signin.php`

## Extended Features (Optional)
- **Input Sanitization**: Used `htmlspecialchars()` for all user-generated content.
- **Modern Hashing**: Using PHP's `password_hash()` for industry-standard credential storage.
