<?php
require_once '../db_connect.php';
check_login();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Delete using prepared statement
    $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        set_flash_message('success', 'Project deleted successfully!');
    } else {
        set_flash_message('error', 'Error deleting project: ' . $conn->error);
    }
    $stmt->close();
} else {
    set_flash_message('error', 'Invalid project ID.');
}

header("Location: manage_projects.php");
exit();
?>