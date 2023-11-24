<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
    $editedContent = $_POST['content'];
    $filePath = 'index.php'; // Path to your index.php file
    //                      //
    // Save the edited content to index.php
    if (file_put_contents($filePath, $editedContent) !== false) {
        echo 'Content saved successfully';
    } else {
        echo 'Failed to save content';
    }
} else {
    echo 'Invalid request';
}
?>