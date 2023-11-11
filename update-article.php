<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $articleId = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Assuming your articles are stored in the 'blog-posts' directory
    $filename = "blog-posts/$articleId.txt";

    if (file_exists($filename)) {
        $article = [
            'title' => $title,
            'content' => $content,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        file_put_contents($filename, json_encode($article));

        echo json_encode(['status' => 'success']);
        exit;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Article not found']);
        exit;
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}
?>