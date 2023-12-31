<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $settingsFile = 'site-settings.xml';
    $xml = simplexml_load_file($settingsFile);

    if ($xml) {
        $xml->title = $_POST['site-title'];
        $xml->copyright = $_POST['copyright-info'];
        $xml->websiteurl = $_POST['website-url'];
        $xml->greetingtxt = $_POST['greeting-txt'];
        $xml->metatxtdesc = $_POST['meta-txt-desc'];
        $xml->metaimg = $_POST['meta-img'];
        

        if ($xml->asXML($settingsFile)) {
            echo 'Settings saved successfully';
        } else {
            echo 'Failed to save settings';
        }
    } else {
        echo 'Failed to load settings';
    }
} else {
    echo 'Invalid request method';
}
?>