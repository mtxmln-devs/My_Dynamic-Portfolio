<?php
/**
 * ==========================================
 * MANAGE SKILLS
 * ==========================================
 * List all skills with Edit/Delete options
 * ==========================================
 */

$page_title = "Manage Skills";
include 'header.php';

// ==========================================
// FETCH ALL SKILLS
// ==========================================
$result = $conn->query("SELECT * FROM skills ORDER BY category, proficiency DESC");
?>

<div class="page-content">
    <div class="page-header">
        <div>
            <h1>📊 Manage Skills</h1>
            <p>View, add, edit, or delete your technical skills</p>
        </div>
        <a href="add_edit_skill.php" class="btn btn-primary">➕ Add New Skill</a>
    </div>
    
    <div class="table-container">
        <?php if ($result->num_rows > 0): ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Skill Name</th>
                        <th>Proficiency</th>
                        <th>Category</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($row['skill_name']); ?></strong></td>
                            <td>
                                <div class="proficiency-bar">
                                    <div class="proficiency-fill" style="width: <?php echo $row['proficiency']; ?>%"></div>
                                    <span class="proficiency-text"><?php echo $row['proficiency']; ?>%</span>
                                </div>
                            </td>
                            <td><span class="badge"><?php echo htmlspecialchars($row['category']); ?></span></td>
                            <td><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                            <td class="action-buttons">
                                <a href="add_edit_skill.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-edit">Edit</a>
                                <a href="delete_skill.php?id=<?php echo $row['id']; ?>" 
                                   class="btn btn-sm btn-delete" 
                                   onclick="return confirm('Are you sure you want to delete <?php echo htmlspecialchars($row['skill_name']); ?>?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <p>📊 No skills found. Add your first skill to get started!</p>
                <a href="add_edit_skill.php" class="btn btn-primary">➕ Add Your First Skill</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>