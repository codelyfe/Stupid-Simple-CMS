<?php
    /*
    ┏┓┏┓┳┓┏┓┓ ┓┏┏┓┏┓
    ┃ ┃┃┃┃┣ ┃ ┗┫┣ ┣ 
    ┗┛┗┛┻┛┗┛┗┛┗┛┻ ┗┛
    */              
    ?>
<?php
$uploadFolder = 'uploads/';

if (isset($_POST['file'])) {
    $filename = $_POST['file'];
    $path = $uploadFolder . $filename;

    if (file_exists($path)) {
        unlink($path);
    }
}

include 'fetch_files.php'; // Include the file to refresh the file list
?>
