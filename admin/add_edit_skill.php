<?php
/**
 * ==========================================
 * ADD/EDIT SKILL
 * ==========================================
 * Form to create or update skills
 * ==========================================
 */

$page_title = "Add/Edit Skill";
include 'header.php';

$edit_mode = false;
$skill = null;

// ==========================================
// CHECK IF EDITING
// ==========================================
if (isset($_GET['id'])) {
    $edit_mode = true;
    $id = intval($_GET['id']);
    
    $stmt = $conn->prepare("SELECT * FROM skills WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $skill = $result->fetch_assoc();
    $stmt->close();
    
    if (!$skill) {
        set_flash_message('error', 'Skill not found.');
        header("Location: manage_skills.php");
        exit();
    }
}

// ==========================================
// HANDLE FORM SUBMISSION
// ==========================================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $skill_name = sanitize_input($_POST['skill_name']);
    $proficiency = intval($_POST['proficiency']);
    $category = sanitize_input($_POST['category']);
    
    // Validation
    if (empty($skill_name) || empty($category)) {
        set_flash_message('error', 'Skill name and category are required.');
    } elseif ($proficiency < 1 || $proficiency > 100) {
        set_flash_message('error', 'Proficiency must be between 1 and 100.');
    } else {
        if ($edit_mode) {
            // Update existing skill using prepared statement
            $id = intval($_POST['id']);
            $stmt = $conn->prepare("UPDATE skills SET skill_name=?, proficiency=?, category=? WHERE id=?");
            $stmt->bind_param("sisi", $skill_name, $proficiency, $category, $id);
        } else {
            // Insert new skill using prepared statement
            $stmt = $conn->prepare("INSERT INTO skills (skill_name, proficiency, category) VALUES (?, ?, ?)");
            $stmt->bind_param("sis", $skill_name, $proficiency, $category);
        }
        
        if ($stmt->execute()) {
            set_flash_message('success', $edit_mode ? 'Skill updated successfully!' : 'Skill added successfully!');
            header("Location: manage_skills.php");
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
            <h1><?php echo $edit_mode ? '✏️ Edit Skill' : '➕ Add New Skill'; ?></h1>
            <p><?php echo $edit_mode ? 'Update skill information' : 'Add a new skill to your portfolio'; ?></p>
        </div>
        <a href="manage_skills.php" class="btn btn-secondary">← Back to Skills</a>
    </div>
    
    <div class="form-container">
        <form method="POST" action="" class="admin-form">
            <?php if ($edit_mode): ?>
                <input type="hidden" name="id" value="<?php echo $skill['id']; ?>">
            <?php endif; ?>
            
            <div class="form-group">
                <label for="skill_name">Skill Name *</label>
                <input type="text" id="skill_name" name="skill_name" 
                       value="<?php echo $skill ? htmlspecialchars($skill['skill_name']) : ''; ?>" 
                       placeholder="e.g., PHP, JavaScript, MySQL" required>
            </div>
            
            <div class="form-group">
                <label for="proficiency">Proficiency Level (1-100) *</label>
                <input type="number" id="proficiency" name="proficiency" 
                       value="<?php echo $skill ? $skill['proficiency'] : '50'; ?>" 
                       min="1" max="100" required>
                <small>Enter a value between 1 (beginner) and 100 (expert)</small>
            </div>
            
            <div class="form-group">
                <label for="category">Category *</label>
                <select id="category" name="category" required>
                    <option value="">-- Select Category --</option>
                    <option value="Frontend" <?php echo ($skill && $skill['category'] == 'Frontend') ? 'selected' : ''; ?>>Frontend</option>
                    <option value="Backend" <?php echo ($skill && $skill['category'] == 'Backend') ? 'selected' : ''; ?>>Backend</option>
                    <option value="Database" <?php echo ($skill && $skill['category'] == 'Database') ? 'selected' : ''; ?>>Database</option>
                    <option value="Tools" <?php echo ($skill && $skill['category'] == 'Tools') ? 'selected' : ''; ?>>Tools</option>
                    <option value="Programming" <?php echo ($skill && $skill['category'] == 'Programming') ? 'selected' : ''; ?>>Programming</option>
                    <option value="Other" <?php echo ($skill && $skill['category'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <?php echo $edit_mode ? '💾 Update Skill' : '➕ Add Skill'; ?>
                </button>
                <a href="manage_skills.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>