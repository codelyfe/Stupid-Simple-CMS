<?php
$uploadFolder = 'uploads/';

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $filename = $file['name'];
    $destination = $uploadFolder . $filename;

    if (!file_exists($destination)) {
        move_uploaded_file($file['tmp_name'], $destination);
    }
}

include 'fetch_files.php'; // Include the file to refresh the file list
?>