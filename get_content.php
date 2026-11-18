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
    'accent' => setting('accent', '#c45c26'),
    'nav_color' => setting('nav_color', '#101216'),
    'heading_color' => setting('heading_color', '#14181f'),
    'card_radius' => setting('card_radius', '18'),
    'overlay' => setting('overlay', '72'),
    'typeface' => setting('typeface', 'fraunces'),
    'content_width' => setting('content_width', '760'),
    'image_height' => setting('image_height', '320'),
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
