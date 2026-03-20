<?php
/**
 * ==========================================
 * ADMIN DASHBOARD
 * ==========================================
 * Main hub for admin panel
 * ==========================================
 */

// 1. START SESSION/AUTHENTICATION AND GET DATABASE CONNECTION ($conn)
// Assuming these variables are defined in an included file like 'config.php'
// You should include your config/auth file here if you haven't already:
// require_once 'config.php'; 

// 2. INCLUDE THE COMMON HEADER TO APPLY ADMIN_STYLE.CSS
// This file contains the <head> section, CSS link, and starts the body/navbar/main container.
require_once 'header.php';

// ==========================================
// GET STATISTICS
// ==========================================

// NOTE: Ensure $conn is a valid database connection object (e.g., MySQLi)
// NOTE: The following lines assume $conn and $_SESSION['username'] are defined.

// Count skills
$result = $conn->query("SELECT COUNT(*) as count FROM skills");
$stats['skills'] = $result->fetch_assoc()['count'];

// Count experience
$result = $conn->query("SELECT COUNT(*) as count FROM experience");
$stats['experience'] = $result->fetch_assoc()['count'];

// Count projects
$result = $conn->query("SELECT COUNT(*) as count FROM projects");
$stats['projects'] = $result->fetch_assoc()['count'];

// Get recent activities (last 5 skills added)
$recent_skills = $conn->query("SELECT skill_name, created_at FROM skills ORDER BY created_at DESC LIMIT 5");

// Get recent experience
$recent_experience = $conn->query("SELECT title, company_institution, created_at FROM experience ORDER BY created_at DESC LIMIT 3");
?>

<div class="dashboard-content">
    <h1>📊 Dashboard Overview</h1>
    <p class="dashboard-subtitle">Welcome back, <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>! Here's your portfolio summary.</p>
    
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">📊</div>
            <div class="stat-info">
                <h3><?php echo $stats['skills']; ?></h3>
                <p>Total Skills</p>
            </div>
            <a href="manage_skills.php" class="stat-link">Manage <br>Skills →</a>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">💼</div>
            <div class="stat-info">
                <h3><?php echo $stats['experience']; ?></h3>
                <p>Experience Entries</p>
            </div>
            <a href="manage_experience.php" class="stat-link">Manage <br>Experience→</a>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">🚀</div>
            <div class="stat-info">
                <h3><?php echo $stats['projects']; ?></h3>
                <p>Projects</p>
            </div>
            <a href="manage_projects.php" class="stat-link">Manage <br>Projects →</a>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">👤</div>
            <div class="stat-info">
                <h3>1</h3>
                <p>Personal Info</p>
            </div>
            <a href="manage_personal_info.php" class="stat-link">Edit <br>Info →</a>
        </div>
    </div>
    
    <div class="dashboard-sections">
        <div class="section-card">
            <h2>⚡ Quick Actions</h2>
            <div class="quick-actions">
                <a href="manage_personal_info.php" class="action-btn">
                    <span class="action-icon">✏️</span>
                    <span>Edit Personal Info</span>
                </a>
                <a href="add_edit_skill.php" class="action-btn">
                    <span class="action-icon">➕</span>
                    <span>Add New Skill</span>
                </a>
                <a href="add_edit_experience.php" class="action-btn">
                    <span class="action-icon">➕</span>
                    <span>Add Experience</span>
                </a>
                <a href="add_edit_project.php" class="action-btn">
                    <span class="action-icon">➕</span>
                    <span>Add Project</span>
                </a>
            </div>
        </div>
        
        <div class="section-card">
            <h2>📝 Recent Activities</h2>
            <div class="activities-list">
                <?php if ($recent_skills->num_rows > 0): ?>
                    <?php while ($skill = $recent_skills->fetch_assoc()): ?>
                        <div class="activity-item">
                            <span class="activity-icon">📊</span>
                            <div class="activity-info">
                                <p><strong><?php echo htmlspecialchars($skill['skill_name']); ?></strong> was added</p>
                                <small><?php echo date('M d, Y - h:i A', strtotime($skill['created_at'])); ?></small>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="no-data">No recent activities</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="section-card" style="margin-top: 20px;">
        <h2>🎓 Recent Experience/Education</h2>
        <div class="recent-items">
            <?php if ($recent_experience->num_rows > 0): ?>
                <?php while ($exp = $recent_experience->fetch_assoc()): ?>
                    <div class="recent-item">
                        <h4><?php echo htmlspecialchars($exp['title']); ?></h4>
                        <p><?php echo htmlspecialchars($exp['company_institution']); ?></p>
                        <small>Added: <?php echo date('M d, Y', strtotime($exp['created_at'])); ?></small>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="no-data">No experience entries yet</p>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="dashboard-footer">
        <a href="../index.php" class="btn btn-secondary" target="_blank">🌐 View Public Portfolio →</a>
    </div>
</div>

<?php 
// 3. INCLUDE THE COMMON FOOTER
// This closes the main container, page content divs, body, and HTML tags.
require_once 'footer.php'; 
?>