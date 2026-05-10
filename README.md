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

## Page Logic & Behavior
- **Admin (`/admin/newuser.php`)**: Provides a form to create new users. Passwords are securely hashed using `password_hash()` before being stored in the database.
- **SignIn (`/socialnet/signin.php`)**: Authenticates users by comparing the provided password with the stored hash using `password_verify()`. On success, it initializes a session.
- **Home (`/socialnet/index.php`)**: Checks for an active session. If unauthorized, it redirects to the Signin page. It fetches the current user's info and lists all other users from the database.
- **Setting (`/socialnet/setting.php`)**: Allows users to update their `description` field in the `account` table.
- **Profile (`/socialnet/profile.php`)**: Uses the `?owner=` query parameter to display a specific user's profile. If the parameter is missing, it defaults to the currently logged-in user.
- **About (`/socialnet/about.php`)**: Displays static student information.
- **SignOut (`/socialnet/signout.php`)**: Terminates the session, clears session cookies, and redirects the user back to the login page.

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
