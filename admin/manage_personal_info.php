<?php
/**
 * ==========================================
 * MANAGE PERSONAL INFO
 * ==========================================
 * Update personal information (single record)
 * ==========================================
 */

$page_title = "Manage Personal Info";
include 'header.php';

// ==========================================
// HANDLE FORM SUBMISSION
// ==========================================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = sanitize_input($_POST['full_name']);
    $email = sanitize_input($_POST['email']);
    $phone = sanitize_input($_POST['phone']);
    $address = sanitize_input($_POST['address']);
    $bio = sanitize_input($_POST['bio']);
    $github_url = sanitize_input($_POST['github_url']);
    $linkedin_url = sanitize_input($_POST['linkedin_url']);
    $profile_image = sanitize_input($_POST['profile_image']);
    
    // Validation
    if (empty($full_name) || empty($email)) {
        set_flash_message('error', 'Full name and email are required.');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        set_flash_message('error', 'Invalid email format.');
    } else {
        // Check if record exists
        $check = $conn->query("SELECT id FROM personal_info LIMIT 1");
        
        if ($check->num_rows > 0) {
            // Update existing record using prepared statement
            $stmt = $conn->prepare("UPDATE personal_info SET full_name=?, email=?, phone=?, address=?, bio=?, github_url=?, linkedin_url=?, profile_image=? WHERE id=1");
            $stmt->bind_param("ssssssss", $full_name, $email, $phone, $address, $bio, $github_url, $linkedin_url, $profile_image);
        } else {
            // Insert new record using prepared statement
            $stmt = $conn->prepare("INSERT INTO personal_info (full_name, email, phone, address, bio, github_url, linkedin_url, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $full_name, $email, $phone, $address, $bio, $github_url, $linkedin_url, $profile_image);
        }
        
        if ($stmt->execute()) {
            set_flash_message('success', 'Personal information updated successfully!');
            header("Location: manage_personal_info.php");
            exit();
        } else {
            set_flash_message('error', 'Error updating information: ' . $conn->error);
        }
        $stmt->close();
    }
}

// ==========================================
// FETCH EXISTING PERSONAL INFO
// ==========================================
$result = $conn->query("SELECT * FROM personal_info LIMIT 1");
$personal_info = $result->fetch_assoc();
?>

<div class="page-content">
    <div class="page-header">
        <div>
            <h1>👤 Manage Personal Information</h1>
            <p>Update your personal details displayed on the portfolio</p>
        </div>
        <a href="dashboard.php" class="btn btn-secondary">← Back to Dashboard</a>
    </div>
    
    <div class="form-container">
        <form method="POST" action="" class="admin-form">
            <div class="form-row">
                <div class="form-group">
                    <label for="full_name">Full Name *</label>
                    <input type="text" id="full_name" name="full_name" 
                           value="<?php echo $personal_info ? htmlspecialchars($personal_info['full_name']) : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" 
                           value="<?php echo $personal_info ? htmlspecialchars($personal_info['email']) : ''; ?>" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" 
                           value="<?php echo $personal_info ? htmlspecialchars($personal_info['phone']) : ''; ?>"
                           placeholder="+63 927 035 4239">
                </div>
                
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" 
                           value="<?php echo $personal_info ? htmlspecialchars($personal_info['address']) : ''; ?>"
                           placeholder="Pili, Camarines Sur, Philippines">
                </div>
            </div>
            
            <div class="form-group">
                <label for="bio">Bio / About Me</label>
                <textarea id="bio" name="bio" rows="5" 
                          placeholder="Write a brief description about yourself..."><?php echo $personal_info ? htmlspecialchars($personal_info['bio']) : ''; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="profile_image">Profile Image Path</label>
                <input type="text" id="profile_image" name="profile_image" 
                       value="<?php echo $personal_info ? htmlspecialchars($personal_info['profile_image']) : 'pik.png'; ?>"
                       placeholder="pik.png">
                <small>Enter the filename of your profile image (must be in root folder)</small>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="github_url">GitHub URL</label>
                    <input type="url" id="github_url" name="github_url" 
                           value="<?php echo $personal_info ? htmlspecialchars($personal_info['github_url']) : ''; ?>" 
                           placeholder="https://github.com/username">
                </div>
                
                <div class="form-group">
                    <label for="linkedin_url">LinkedIn URL</label>
                    <input type="url" id="linkedin_url" name="linkedin_url" 
                           value="<?php echo $personal_info ? htmlspecialchars($personal_info['linkedin_url']) : ''; ?>" 
                           placeholder="https://linkedin.com/in/username">
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Update Information</button>
                <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>