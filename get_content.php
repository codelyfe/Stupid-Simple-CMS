<?php
header('Content-Type: text/plain; charset=utf-8');
header('Cache-Control: public, max-age=60');

if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !isset($_GET['element'])) {
    echo 'Invalid request';
    exit;
}

$xml = @simplexml_load_file('theme.xml');
if ($xml === false) {
    echo 'Invalid request';
    exit;
}

$theme = [
    'background' => (string) $xml->background,
    'fontcolor' => (string) $xml->fontcolor,
    'article_background' => (string) $xml->article_background_color,
    'article_btn_background' => (string) $xml->article_btn_background_color,
    'article_btnfc_background' => (string) $xml->article_btn_font_color,
    'background_image' => isset($xml->background_image) ? (string) $xml->background_image : '',
];

$element = $_GET['element'];

if ($element === 'all') {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($theme);
    exit;
}

if (!array_key_exists($element, $theme)) {
    echo 'Invalid element';
    exit;
}

echo $theme[$element];
