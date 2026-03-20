<?php
/**
 * ==========================================
 * DELETE SKILL
 * ==========================================
 * Handles skill deletion with prepared statement
 * ==========================================
 */

require_once '../db_connect.php';
check_login();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Delete using prepared statement
    $stmt = $conn->prepare("DELETE FROM skills WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        set_flash_message('success', 'Skill deleted successfully!');
    } else {
        set_flash_message('error', 'Error deleting skill: ' . $conn->error);
    }
    $stmt->close();
} else {
    set_flash_message('error', 'Invalid skill ID.');
}

header("Location: manage_skills.php");
exit();
?>