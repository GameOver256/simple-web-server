<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['file'])) {
    $file = basename($_GET['file']);
    $file_path = "uploads/" . $file;

    if (file_exists($file_path)) {
        unlink($file_path); // Delete the file
        echo "File deleted successfully.";
    } else {
        echo "File not found.";
    }
}
header("Location: dashboard.php");
exit();
?>
