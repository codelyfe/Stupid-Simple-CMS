<?php
$settingsFile = 'site-settings.xml';
$xml = simplexml_load_file($settingsFile);

if ($xml) {
    $title = (string) $xml->title;
    $copyright = (string) $xml->copyright;
    $websiteurl = (string) $xml->websiteurl;
    $greetingtxt = (string) $xml->greetingtxt;

    $settings = array(
        'title' => $title,
        'copyright' => $copyright,
        'websiteurl' => $websiteurl,
        'greetingtxt' => $greetingtxt
    );

    header('Content-Type: application/json');
    echo json_encode($settings);
} else {
    echo json_encode(array('error' => 'Failed to load settings'));
}
?>
