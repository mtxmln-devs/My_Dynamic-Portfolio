<?php
$page_title = "Add/Edit Experience";
include 'header.php';

$edit_mode = false;
$experience = null;

// Check if editing
if (isset($_GET['id'])) {
    $edit_mode = true;
    $id = intval($_GET['id']);
    
    $stmt = $conn->prepare("SELECT * FROM experience WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $experience = $result->fetch_assoc();
    $stmt->close();
    
    if (!$experience) {
        set_flash_message('error', 'Experience entry not found.');
        header("Location: manage_experience.php");
        exit();
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = sanitize_input($_POST['title']);
    $company_institution = sanitize_input($_POST['company_institution']);
    $location = sanitize_input($_POST['location']);
    $start_date = sanitize_input($_POST['start_date']);
    $end_date = !empty($_POST['end_date']) ? sanitize_input($_POST['end_date']) : NULL;
    $description = sanitize_input($_POST['description']);
    $type = sanitize_input($_POST['type']);
    
    // Validation
    if (empty($title) || empty($company_institution) || empty($start_date) || empty($type)) {
        set_flash_message('error', 'Title, company/institution, start date, and type are required.');
    } else {
        if ($edit_mode) {
            // Update existing experience
            $id = intval($_POST['id']);
            $stmt = $conn->prepare("UPDATE experience SET title=?, company_institution=?, location=?, start_date=?, end_date=?, description=?, type=? WHERE id=?");
            $stmt->bind_param("sssssssi", $title, $company_institution, $location, $start_date, $end_date, $description, $type, $id);
        } else {
            // Insert new experience
            $stmt = $conn->prepare("INSERT INTO experience (title, company_institution, location, start_date, end_date, description, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $title, $company_institution, $location, $start_date, $end_date, $description, $type);
        }
        
        if ($stmt->execute()) {
            set_flash_message('success', $edit_mode ? 'Experience updated successfully!' : 'Experience added successfully!');
            header("Location: manage_experience.php");
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
            <h1><?php echo $edit_mode ? '✏️ Edit Experience' : '➕ Add New Experience'; ?></h1>
            <p><?php echo $edit_mode ? 'Update experience details' : 'Add work experience or education entry'; ?></p>
        </div>
        <a href="manage_experience.php" class="btn btn-secondary">← Back to Experience</a>
    </div>
    
    <div class="form-container">
        <form method="POST" action="" class="admin-form">
            <?php if ($edit_mode): ?>
                <input type="hidden" name="id" value="<?php echo $experience['id']; ?>">
            <?php endif; ?>
            
            <div class="form-group">
                <label for="type">Type *</label>
                <select id="type" name="type" required>
                    <option value="">-- Select Type --</option>
                    <option value="work" <?php echo ($experience && $experience['type'] == 'work') ? 'selected' : ''; ?>>Work Experience</option>
                    <option value="education" <?php echo ($experience && $experience['type'] == 'education') ? 'selected' : ''; ?>>Education</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="title">Title / Position *</label>
                <input type="text" id="title" name="title" 
                       value="<?php echo $experience ? htmlspecialchars($experience['title']) : ''; ?>" 
                       placeholder="e.g., Web Developer, Bachelor of Science" required>
            </div>
            
            <div class="form-group">
                <label for="company_institution">Company / Institution *</label>
                <input type="text" id="company_institution" name="company_institution" 
                       value="<?php echo $experience ? htmlspecialchars($experience['company_institution']) : ''; ?>" 
                       placeholder="e.g., Tech Company Inc., State University" required>
            </div>
            
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" 
                       value="<?php echo $experience ? htmlspecialchars($experience['location']) : ''; ?>" 
                       placeholder="e.g., New York, USA">
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="start_date">Start Date *</label>
                    <input type="date" id="start_date" name="start_date" 
                           value="<?php echo $experience ? $experience['start_date'] : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" id="end_date" name="end_date" 
                           value="<?php echo $experience ? $experience['end_date'] : ''; ?>">
                    <small>Leave empty if currently ongoing</small>
                </div>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="5" 
                          placeholder="Describe your responsibilities, achievements, or coursework..."><?php echo $experience ? htmlspecialchars($experience['description']) : ''; ?></textarea>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <?php echo $edit_mode ? '💾 Update Experience' : '➕ Add Experience'; ?>
                </button>
                <a href="manage_experience.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>