<?php
/**
 * ==========================================
 * ADMIN HEADER TEMPLATE - CSS FIXED
 * ==========================================
 */

require_once '../db_connect.php';
check_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'Admin Dashboard'; ?> - Portfolio</title>
    
    <!-- ADMIN CSS - ABSOLUTE PATH -->
    <link rel="stylesheet" href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/admin_style.css'; ?>">
    
    <!-- FALLBACK: Relative Path -->
    <link rel="stylesheet" href="admin_style.css">
    
    <style>
        /* Inline backup styles in case CSS doesn't load */
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: #f5f7fa; 
            margin: 0;
            padding: 0;
        }
        .admin-navbar {
            background: #2c3e50;
            color: white;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar-brand h2 {
            color: white;
            margin: 0;
            padding: 20px 0;
        }
        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 35px;
        }
    </style>
</head>
<body>
    <!-- ========================================== -->
    <!-- ADMIN NAVIGATION BAR -->
    <!-- ========================================== -->
    <nav class="admin-navbar">
        <div class="navbar-brand">
            <h2>📊 Administrator Page</h2>
        </div>
        <ul class="navbar-menu">
            <li><a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">Dashboard</a></li>
            <li><a href="manage_personal_info.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'manage_personal_info.php' ? 'active' : ''; ?>">Personal Info</a></li>
            <li><a href="manage_skills.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'manage_skills.php' || basename($_SERVER['PHP_SELF']) == 'add_edit_skill.php' ? 'active' : ''; ?>">Skills</a></li>
            <li><a href="manage_experience.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'manage_experience.php' || basename($_SERVER['PHP_SELF']) == 'add_edit_experience.php' ? 'active' : ''; ?>">Experience</a></li>
            <li><a href="manage_projects.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'manage_projects.php' || basename($_SERVER['PHP_SELF']) == 'add_edit_project.php' ? 'active' : ''; ?>">Projects</a></li>
        </ul>
        <div class="navbar-user">
            <span>Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></span>
            <a href="logout.php" class="btn btn-logout">Logout</a>
        </div>
    </nav>
    
    <!-- ========================================== -->
    <!-- MAIN CONTENT CONTAINER -->
    <!-- ========================================== -->
    <div class="admin-container">
        <?php display_flash_message(); ?>