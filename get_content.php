<?php
require_once __DIR__ . '/includes/store.php';
header('Cache-Control: public, max-age=60');

if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !isset($_GET['element'])) {
    echo 'Invalid request';
    exit;
}

$theme = [
    'background' => setting('background'),
    'fontcolor' => setting('fontcolor'),
    'article_background' => setting('article_background_color'),
    'article_btn_background' => setting('article_btn_background_color'),
    'article_btnfc_background' => setting('article_btn_font_color'),
    'background_image' => setting('background_image'),
];

$element = $_GET['element'];
if ($element === 'all') {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($theme);
    exit;
}
header('Content-Type: text/plain; charset=utf-8');
if (!array_key_exists($element, $theme)) {
    echo 'Invalid element';
    exit;
}
echo $theme[$element];
