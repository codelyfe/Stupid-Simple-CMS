<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['element'])) {
    $element = $_GET['element'];

    $xmlFile = 'data.xml'; // Replace with your XML file path
    $xml = simplexml_load_file($xmlFile);

    switch ($element) {
        case 'background':
            echo $xml->background;
            break;

        case 'fontcolor':
            echo $xml->fontcolor;
            break;

        case 'background_image':
            if (isset($xml->background_image)) {
                echo $xml->background_image;
            } else {
                echo 'No data found for background image';
            }
            break;
        default:
            echo 'Invalid element';
            break;
    }
} else {
    echo 'Invalid request';
}
?>