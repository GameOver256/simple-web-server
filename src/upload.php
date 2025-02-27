<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "You must be logged in to upload files.";
    exit();
}

$target_dir = "uploads/"; // Upload directory
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Limit file size (5MB max)
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow only specific file types
$allowed_types = ["jpg", "png", "gif", "pdf", "txt"];
if (!in_array($fileType, $allowed_types)) {
    echo "Sorry, only JPG, PNG, GIF, PDF, and TXT files are allowed.";
    $uploadOk = 0;
}

// Check if everything is OK
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
