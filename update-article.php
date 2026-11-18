<?php
require_once __DIR__ . '/includes/store.php';
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}
$ok = article_update(
    $_POST['id'] ?? 0,
    $_POST['title'] ?? '',
    $_POST['content'] ?? '',
    $_POST['image_url'] ?? '',
    $_POST['category'] ?? ''
);
echo json_encode($ok
    ? ['status' => 'success']
    : ['status' => 'error', 'message' => 'Article not found']);
