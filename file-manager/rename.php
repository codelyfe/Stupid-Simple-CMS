<?php
    /*
    ┏┓┏┓┳┓┏┓┓ ┓┏┏┓┏┓
    ┃ ┃┃┃┃┣ ┃ ┗┫┣ ┣ 
    ┗┛┗┛┻┛┗┛┗┛┗┛┻ ┗┛
    */              
    ?>
<?php
$uploadFolder = 'uploads/';

if (isset($_POST['oldName']) && isset($_POST['newName'])) {
    $oldName = $_POST['oldName'];
    $newName = $_POST['newName'];

    $oldPath = $uploadFolder . $oldName;
    $newPath = $uploadFolder . $newName;

    if (file_exists($oldPath)) {
        rename($oldPath, $newPath);
    }
}

include 'fetch_files.php'; // Include the file to refresh the file list
?>