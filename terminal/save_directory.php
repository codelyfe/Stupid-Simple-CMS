<?php
    /*
    ┏┓┏┓┳┓┏┓┓ ┓┏┏┓┏┓
    ┃ ┃┃┃┃┣ ┃ ┗┫┣ ┣ 
    ┗┛┗┛┻┛┗┛┗┛┗┛┻ ┗┛
    */              
    ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['path'])) {
    $newPath = $_POST['path'];
    
    $xml = new DOMDocument('1.0');
    $xml->formatOutput = true;
    $directory = $xml->createElement('directory');
    $path = $xml->createElement('path', $newPath);
    $directory->appendChild($path);
    $xml->appendChild($directory);
    $xml->save('directory.xml');
}
?>