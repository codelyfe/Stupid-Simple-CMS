<?php
require_once __DIR__ . '/includes/store.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo 'Invalid request';
    exit;
}
$map = [
    'background' => 'background',
    'fontcolor' => 'fontcolor',
    'article_background_color' => 'article_background_color',
    'article_btn_background_color' => 'article_btn_background_color',
    'article_btn_font_color' => 'article_btn_font_color',
    'accent' => 'accent',
    'nav_color' => 'nav_color',
    'heading_color' => 'heading_color',
    'card_radius' => 'card_radius',
    'overlay' => 'overlay',
    'typeface' => 'typeface',
    'content_width' => 'content_width',
    'image_height' => 'image_height',
];
foreach ($map as $key => $field) {
    if (isset($_POST[$field])) {
        setting_put($key, $_POST[$field]);
    }
}
if (isset($_POST['background_image_url'])) {
    $imageUrl = $_POST['background_image_url'];
    if (!filter_var($imageUrl, FILTER_VALIDATE_URL)) {
        echo 'Invalid URL format!';
        exit;
    }
    setting_put('background_image', $imageUrl);
    echo 'Background image URL updated successfully!';
    exit;
}
echo 'Saved';
