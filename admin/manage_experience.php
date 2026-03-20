<?php
$page_title = "Manage Experience";
include 'header.php';

// Fetch all experience entries
$result = $conn->query("SELECT * FROM experience ORDER BY start_date DESC");
?>

<div class="page-content">
    <div class="page-header">
        <div>
            <h1>💼 Manage Experience & Education</h1>
            <p>View, add, edit, or delete your work and education history</p>
        </div>
        <a href="add_edit_experience.php" class="btn btn-primary">➕ Add New Entry</a>
    </div>
    
    <div class="table-container">
        <?php if ($result->num_rows > 0): ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Company/Institution</th>
                        <th>Type</th>
                        <th>Duration</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($row['title']); ?></strong></td>
                            <td><?php echo htmlspecialchars($row['company_institution']); ?></td>
                            <td>
                                <span class="badge badge-<?php echo $row['type']; ?>">
                                    <?php echo ucfirst($row['type']); ?>
                                </span>
                            </td>
                            <td>
                                <?php 
                                    $start = date('M Y', strtotime($row['start_date']));
                                    $end = $row['end_date'] ? date('M Y', strtotime($row['end_date'])) : 'Present';
                                    echo "$start - $end";
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($row['location']); ?></td>
                            <td class="action-buttons">
                                <a href="add_edit_experience.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-edit">Edit</a>
                                <a href="delete_experience.php?id=<?php echo $row['id']; ?>" 
                                   class="btn btn-sm btn-delete" 
                                   onclick="return confirm('Are you sure you want to delete this entry?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <p>💼 No experience entries found. Add your first entry to get started!</p>
                <a href="add_edit_experience.php" class="btn btn-primary">➕ Add Your First Entry</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>