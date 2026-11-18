<?php
require_once __DIR__ . '/../includes/store.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo 'Invalid request method';
    exit;
}
$map = [
    'title' => 'site-title',
    'copyright' => 'copyright-info',
    'greetingtxt' => 'greeting-txt',
    'metatxtdesc' => 'meta-txt-desc',
    'metaimg' => 'meta-img',
];
foreach ($map as $key => $field) {
    setting_put($key, $_POST[$field] ?? '');
}
echo 'Settings saved successfully';
