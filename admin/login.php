<?php
/**
 * ==========================================
 * ADMIN LOGIN PAGE - WITH CSS LINK
 * ==========================================
 */

session_start();

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'portfolio_db');

// Create MySQLi Connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

// If already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = '';

// ==========================================
// HANDLE LOGIN FORM SUBMISSION
// ==========================================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    // Validation
    if (empty($username) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        // Prepare statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Login successful - Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['login_time'] = time();
                
                // Redirect to dashboard
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Invalid username or password.";
            }
        } else {
            $error = "Invalid username or password.";
        }
        $stmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Portfolio Dashboard</title>
    
    <!-- Link to external CSS -->
    <link rel="stylesheet" href="admin_style.css">
    
    <!-- Inline backup styles -->
    <style>
        /* Backup inline styles in case CSS file doesn't load */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-page {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .login-container { width: 100%; max-width: 450px; }
        .login-box {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }
        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .login-header h1 { font-size: 32px; margin-bottom: 8px; }
        .login-header p { font-size: 15px; opacity: 0.95; }
        .alert {
            padding: 16px 22px;
            margin: 20px 30px 0;
            border-radius: 8px;
            font-size: 14px;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        .login-form { padding: 35px 30px; }
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
        }
        .form-group input {
            width: 100%;
            padding: 13px 16px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 15px;
        }
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }
        .btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .login-footer {
            padding: 25px 30px;
            background: #f8f9fa;
            text-align: center;
            font-size: 13px;
            color: #6c757d;
        }
        .login-footer a {
            color: #667eea;
            text-decoration: none;
        }
    </style>
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-box">
            <!-- Login Header -->
            <div class="login-header">
                <h1>📊 Portfolio Admin</h1>
                <p>Sign in to your dashboard</p>
            </div>
            
            <!-- Error Message -->
            <?php if (!empty($error)): ?>
                <div class="alert alert-error">
                    ⚠️ <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <!-- Login Form -->
            <form method="POST" action="" class="login-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required autofocus 
                           value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" 
                           placeholder="Enter your username">
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required 
                           placeholder="Enter your password">
                </div>
                
                <button type="submit" class="btn">🔐 Sign In</button>
            </form>
            
            <!-- Login Footer -->
            <div class="login-footer">
                <a href="../index.php">← Back to Portfolio</a>
            </div>
        </div>
    </div>
</body>
</html> 