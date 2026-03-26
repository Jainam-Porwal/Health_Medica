<?php
session_start();
require_once 'database.php';

// Check if user is logged in (redirect if not - must be before any HTML output)
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$page_title = 'Dashboard';
include 'header.php';

// Get user details
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT full_name, email, phone, created_at FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>

  </div><!-- close hero_area from header -->

    <style>
        .dashboard-container {
            background: #f5f5f5;
            padding: 0;
        }
        
        .dashboard-content {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }
        
        .welcome-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .welcome-card h2 {
            color: #333;
            margin-bottom: 10px;
        }
        
        .welcome-card p {
            color: #666;
            margin: 0;
        }
        
        .profile-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .profile-card h3 {
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .profile-info {
            display: grid;
            gap: 20px;
        }
        
        .info-item {
            display: flex;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 8px;
        }
        
        .info-label {
            font-weight: 600;
            color: #00c6a9;
            width: 150px;
            flex-shrink: 0;
        }
        
        .info-value {
            color: #333;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-left: 4px solid #00c6a9;
        }
        
        .stat-card h4 {
            color: #999;
            font-size: 14px;
            margin: 0 0 10px 0;
            text-transform: uppercase;
            font-weight: 600;
        }
        
        .stat-card .stat-value {
            color: #333;
            font-size: 28px;
            font-weight: 700;
            margin: 0;
        }
    </style>

    <div class="dashboard-container">

        
        <div class="dashboard-content">
            <div class="welcome-card">
                <h2>Welcome to Health Medica!</h2>
                <p>You have successfully logged into your account. Manage your profile and appointments from here.</p>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <h4>Account Status</h4>
                    <p class="stat-value">Active</p>
                </div>
                <div class="stat-card">
                    <h4>Member Since</h4>
                    <p class="stat-value"><?php echo date('M Y', strtotime($user['created_at'])); ?></p>
                </div>
                <div class="stat-card">
                    <h4>Appointments</h4>
                    <p class="stat-value">0</p>
                </div>
            </div>
            
            <div class="profile-card">
                <h3>Profile Information</h3>
                <div class="profile-info">
                    <div class="info-item">
                        <div class="info-label">Full Name:</div>
                        <div class="info-value"><?php echo htmlspecialchars($user['full_name']); ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Email Address:</div>
                        <div class="info-value"><?php echo htmlspecialchars($user['email']); ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Phone Number:</div>
                        <div class="info-value"><?php echo htmlspecialchars($user['phone']); ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Account Created:</div>
                        <div class="info-value"><?php echo date('F d, Y h:i A', strtotime($user['created_at'])); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
