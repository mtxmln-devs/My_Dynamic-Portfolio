<?php
require_once '../db_connect.php';
check_login();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Delete using prepared statement
    $stmt = $conn->prepare("DELETE FROM experience WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        set_flash_message('success', 'Experience entry deleted successfully!');
    } else {
        set_flash_message('error', 'Error deleting entry: ' . $conn->error);
    }
    $stmt->close();
} else {
    set_flash_message('error', 'Invalid experience ID.');
}

header("Location: manage_experience.php");
exit();
?>