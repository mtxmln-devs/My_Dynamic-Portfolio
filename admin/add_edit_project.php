<?php
$page_title = "Add/Edit Project";
include 'header.php';

$edit_mode = false;
$project = null;

// Check if editing
if (isset($_GET['id'])) {
    $edit_mode = true;
    $id = intval($_GET['id']);
    
    $stmt = $conn->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $project = $result->fetch_assoc();
    $stmt->close();
    
    if (!$project) {
        set_flash_message('error', 'Project not found.');
        header("Location: manage_projects.php");
        exit();
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_name = sanitize_input($_POST['project_name']);
    $description = sanitize_input($_POST['description']);
    $technologies = sanitize_input($_POST['technologies']);
    $project_url = sanitize_input($_POST['project_url']);
    $start_date = !empty($_POST['start_date']) ? sanitize_input($_POST['start_date']) : NULL;
    $end_date = !empty($_POST['end_date']) ? sanitize_input($_POST['end_date']) : NULL;
    
    // Validation
    if (empty($project_name)) {
        set_flash_message('error', 'Project name is required.');
    } else {
        if ($edit_mode) {
            // Update existing project
            $id = intval($_POST['id']);
            $stmt = $conn->prepare("UPDATE projects SET project_name=?, description=?, technologies=?, project_url=?, start_date=?, end_date=? WHERE id=?");
            $stmt->bind_param("ssssssi", $project_name, $description, $technologies, $project_url, $start_date, $end_date, $id);
        } else {
            // Insert new project
            $stmt = $conn->prepare("INSERT INTO projects (project_name, description, technologies, project_url, start_date, end_date) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $project_name, $description, $technologies, $project_url, $start_date, $end_date);
        }
        
        if ($stmt->execute()) {
            set_flash_message('success', $edit_mode ? 'Project updated successfully!' : 'Project added successfully!');
            header("Location: manage_projects.php");
            exit();
        } else {
            set_flash_message('error', 'Error: ' . $conn->error);
        }
        $stmt->close();
    }
}
?>

<div class="page-content">
    <div class="page-header">
        <div>
            <h1><?php echo $edit_mode ? '✏️ Edit Project' : '➕ Add New Project'; ?></h1>
            <p><?php echo $edit_mode ? 'Update project details' : 'Add a new project to your portfolio'; ?></p>
        </div>
        <a href="manage_projects.php" class="btn btn-secondary">← Back to Projects</a>
    </div>
    
    <div class="form-container">
        <form method="POST" action="" class="admin-form">
            <?php if ($edit_mode): ?>
                <input type="hidden" name="id" value="<?php echo $project['id']; ?>">
            <?php endif; ?>
            
            <div class="form-group">
                <label for="project_name">Project Name *</label>
                <input type="text" id="project_name" name="project_name" 
                       value="<?php echo $project ? htmlspecialchars($project['project_name']) : ''; ?>" 
                       placeholder="e.g., E-Commerce Platform" required>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="5" 
                          placeholder="Describe what the project does and your role..."><?php echo $project ? htmlspecialchars($project['description']) : ''; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="technologies">Technologies Used</label>
                <input type="text" id="technologies" name="technologies" 
                       value="<?php echo $project ? htmlspecialchars($project['technologies']) : ''; ?>" 
                       placeholder="e.g., PHP, MySQL, JavaScript, Bootstrap">
                <small>Separate multiple technologies with commas</small>
            </div>
            
            <div class="form-group">
                <label for="project_url">Project URL</label>
                <input type="url" id="project_url" name="project_url" 
                       value="<?php echo $project ? htmlspecialchars($project['project_url']) : ''; ?>" 
                       placeholder="https://example.com/project">
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" id="start_date" name="start_date" 
                           value="<?php echo $project ? $project['start_date'] : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" id="end_date" name="end_date" 
                           value="<?php echo $project ? $project['end_date'] : ''; ?>">
                    <small>Leave empty if ongoing</small>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <?php echo $edit_mode ? '💾 Update Project' : '➕ Add Project'; ?>
                </button>
                <a href="manage_projects.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>