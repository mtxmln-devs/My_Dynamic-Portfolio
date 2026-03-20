<?php
$page_title = "Manage Projects";
include 'header.php';

// Fetch all projects
$result = $conn->query("SELECT * FROM projects ORDER BY start_date DESC");
?>

<div class="page-content">
    <div class="page-header">
        <div>
            <h1>🚀 Manage Projects</h1>
            <p>View, add, edit, or delete your portfolio projects</p>
        </div>
        <a href="add_edit_project.php" class="btn btn-primary">➕ Add New Project</a>
    </div>
    
    <div class="table-container">
        <?php if ($result->num_rows > 0): ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Project Name</th>
                        <th>Technologies</th>
                        <th>Duration</th>
                        <th>URL</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($row['project_name']); ?></strong></td>
                            <td><?php echo htmlspecialchars($row['technologies']); ?></td>
                            <td>
                                <?php 
                                    if ($row['start_date']) {
                                        $start = date('M Y', strtotime($row['start_date']));
                                        $end = $row['end_date'] ? date('M Y', strtotime($row['end_date'])) : 'Ongoing';
                                        echo "$start - $end";
                                    } else {
                                        echo 'N/A';
                                    }
                                ?>
                            </td>
                            <td>
                                <?php if ($row['project_url']): ?>
                                    <a href="<?php echo htmlspecialchars($row['project_url']); ?>" target="_blank" class="link-external">View →</a>
                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </td>
                            <td class="action-buttons">
                                <a href="add_edit_project.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-edit">Edit</a>
                                <a href="delete_project.php?id=<?php echo $row['id']; ?>" 
                                   class="btn btn-sm btn-delete" 
                                   onclick="return confirm('Are you sure you want to delete this project?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <p>🚀 No projects found. Add your first project to get started!</p>
                <a href="add_edit_project.php" class="btn btn-primary">➕ Add Your First Project</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>