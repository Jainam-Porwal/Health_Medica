# Health Medica - PHP Login System

A complete PHP login and registration system with MySQL database integration for the Health Medica website.

## Features

- User Registration (Sign Up)
- User Login with Session Management
- Secure Password Hashing using PHP's password_hash()
- MySQL Database Integration
- Form Validation
- Session Management
- User Dashboard
- Logout Functionality
- Responsive Design

## Files Included

1. **database.php** - Database connection configuration
2. **create_database.sql** - SQL script to create database and tables
3. **signup.php** - User registration page
4. **login.php** - User login page
5. **dashboard.php** - User dashboard (protected page)
6. **logout.php** - Logout script
7. **README.md** - This file

## Installation Instructions

### Step 1: Database Setup

1. Open phpMyAdmin or MySQL command line
2. Import the `create_database.sql` file OR run the following commands:

```sql
CREATE DATABASE IF NOT EXISTS health_medica;
USE health_medica;

CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE INDEX idx_email ON users(email);
```

### Step 2: Configure Database Connection

1. Open `database.php`
2. Update the database credentials if needed:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');        // Change if needed
   define('DB_PASS', '');            // Add password if needed
   define('DB_NAME', 'health_medica');
   ```

### Step 3: Upload Files

Upload all PHP files to your web server:
- database.php
- signup.php
- login.php
- dashboard.php
- logout.php

### Step 4: Update index.html

Update the Login and Sign Up links in your `index.html` file:

```html
<!-- Find these lines (around line 106-117) -->
<a href="login.php">
  <i class="fa fa-user" aria-hidden="true"></i>
  <span>Login</span>
</a>
<a href="signup.php">
  <i class="fa fa-user" aria-hidden="true"></i>
  <span>Sign Up</span>
</a>
```

## Usage

### User Registration
1. Navigate to `signup.php`
2. Fill in the registration form:
   - Full Name
   - Email Address
   - Phone Number
   - Password (minimum 6 characters)
   - Confirm Password
3. Click "Sign Up"
4. You will be redirected to the login page

### User Login
1. Navigate to `login.php`
2. Enter your email and password
3. Click "Login"
4. You will be redirected to the dashboard

### Dashboard
- After successful login, users are redirected to `dashboard.php`
- Shows user profile information
- Displays account statistics
- Provides logout functionality

## Security Features

1. **Password Hashing**: Passwords are hashed using PHP's `password_hash()` function with bcrypt
2. **Prepared Statements**: All database queries use prepared statements to prevent SQL injection
3. **Input Validation**: Server-side validation for all form inputs
4. **Email Validation**: Validates email format before registration
5. **Session Management**: Secure session handling for logged-in users
6. **XSS Protection**: Output is escaped using `htmlspecialchars()`

## Database Schema

### users Table

| Column      | Type         | Description                          |
|-------------|--------------|--------------------------------------|
| id          | INT(11)      | Primary key, auto-increment          |
| full_name   | VARCHAR(100) | User's full name                     |
| email       | VARCHAR(100) | User's email (unique)                |
| phone       | VARCHAR(20)  | User's phone number                  |
| password    | VARCHAR(255) | Hashed password                      |
| created_at  | TIMESTAMP    | Account creation timestamp           |
| updated_at  | TIMESTAMP    | Last update timestamp                |

## Customization

### Changing Colors
The login and signup pages use a purple gradient. To change colors, modify the CSS in:
- `login.php` - Look for the gradient in `.login-container`
- `signup.php` - Look for the gradient in `.signup-container`
- `dashboard.php` - Look for the gradient in `.dashboard-header`

### Adding More Features
You can extend this system by:
- Adding password reset functionality
- Implementing email verification
- Adding user profile editing
- Creating appointment booking system
- Adding admin panel

## Troubleshooting

### "Connection failed" error
- Check database credentials in `database.php`
- Ensure MySQL server is running
- Verify database exists

### "Email already registered" error
- The email is already in the database
- Use a different email or login with existing credentials

### Session issues
- Ensure PHP session support is enabled
- Check file permissions on session storage directory

## Requirements

- PHP 7.0 or higher
- MySQL 5.6 or higher
- Apache/Nginx web server
- PHP mysqli extension enabled

## Support

For issues or questions, please check:
1. All files are uploaded correctly
2. Database is created and configured
3. PHP and MySQL are running
4. File permissions are correct

## License

Free to use for personal and commercial projects.
