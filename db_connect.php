<?php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'portfolio_db');

// Create MySQLi Connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check Connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Set Charset to UTF-8
$conn->set_charset("utf8mb4");

/**
 * ==========================================
 * FUNCTION: sanitize_input()
 * Sanitizes user input to prevent XSS
 * ==========================================
 */
function sanitize_input($data) {
    if ($data === null) {
        return null;
    }
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * ==========================================
 * FUNCTION: check_login()
 * Verifies user session and redirects if not logged in
 * ==========================================
 */
function check_login() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
}

/**
 * ==========================================
 * FUNCTION: set_flash_message()
 * Sets a flash message for user feedback
 * ==========================================
 */
function set_flash_message($type, $message) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['flash_type'] = $type;
    $_SESSION['flash_message'] = $message;
}

/**
 * ==========================================
 * FUNCTION: display_flash_message()
 * Displays and clears flash message
 * ==========================================
 */
function display_flash_message() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (isset($_SESSION['flash_message'])) {
        $type = $_SESSION['flash_type'];
        $message = $_SESSION['flash_message'];
        $alert_class = ($type === 'success') ? 'alert-success' : 'alert-error';
        
        echo "<div class='alert {$alert_class}'>";
        if ($type === 'success') {
            echo "✅ ";
        } else {
            echo "⚠️ ";
        }
        echo htmlspecialchars($message);
        echo "</div>";
        
        // Clear flash message after displaying
        unset($_SESSION['flash_message']);
        unset($_SESSION['flash_type']);
    }
}

?>