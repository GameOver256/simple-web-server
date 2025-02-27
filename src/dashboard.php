<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Directory where files are stored
$upload_dir = "uploads/";
$files = array_diff(scandir($upload_dir), array('.', '..')); // Get all files except "." and ".."
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <a href="logout.php">Logout</a>

    <h3>Upload a File</h3>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" required><br><br>
        <button type="submit" name="submit">Upload</button>
    </form>

    <h3>Uploaded Files</h3>
    <?php if (!empty($files)): ?>
        <ul>
            <?php foreach ($files as $file): ?>
                <li>
                    <a href="uploads/<?php echo $file; ?>" download><?php echo $file; ?></a> 
                    | <a href="delete.php?file=<?php echo urlencode($file); ?>" style="color: red;">Delete</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No files uploaded yet.</p>
    <?php endif; ?>
</body>
</html>
