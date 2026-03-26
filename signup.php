<?php
session_start();
require_once 'database.php';

// If user is already logged in, redirect to index page
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validation
    if (empty($full_name) || empty($email) || empty($phone) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long!";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $error = "Email already registered! Please login.";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (full_name, email, phone, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $full_name, $email, $phone, $hashed_password);
            
            if ($stmt->execute()) {
                $success = "Registration successful! Redirecting to login...";
                header("refresh:2;url=login.php");
            } else {
                $error = "Registration failed! Please try again.";
            }
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Sign Up - Health Medica</title>
    
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
    
    <style>
        .signup-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
        }
        
        .signup-box {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            padding: 40px;
            max-width: 500px;
            width: 100%;
        }
        
        .signup-box h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-weight: 700;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            font-weight: 500;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .btn-signup {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }
        
        .btn-signup:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        
        .alert {
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .alert-danger {
            background-color: #fee;
            color: #c33;
            border: 1px solid #fcc;
        }
        
        .alert-success {
            background-color: #efe;
            color: #3c3;
            border: 1px solid #cfc;
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }
        
        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="signup-container">
        <div class="signup-box">
            <h2>Create Account</h2>
            
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" 
                           value="<?php echo isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : ''; ?>" 
                           required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" 
                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" 
                           required>
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" 
                           value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>" 
                           required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" 
                           minlength="6" required>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" 
                           minlength="6" required>
                </div>
                
                <button type="submit" class="btn-signup">Sign Up</button>
            </form>
            
            <div class="login-link">
                Already have an account? <a href="login.php">Login here</a>
            </div>
        </div>
    </div>
</body>
</html>
