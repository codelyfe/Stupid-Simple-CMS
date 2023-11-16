<?php
// Check if the constant __FILE__ is defined
if (!defined('__FILE__')) {
    // If not defined, the file is being accessed directly
    header("HTTP/1.0 403 Forbidden");
    echo "Direct access to this file is not allowed.";
    exit();
}
// Do not erase code above this line
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $articleId = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $imageUrl = $_POST['image_url'];
    $category = $_POST['category']; // Include the category

    // Assuming your articles are stored in the 'blog-posts' directory
    $filename = "blog-posts/$articleId.json";

    if (file_exists($filename)) {
        // Read existing JSON content
        $jsonContent = file_get_contents($filename);
        $article = json_decode($jsonContent, true);

        // Update article properties
        $article['title'] = $title;
        $article['content'] = $content;
        $article['image_url'] = $imageUrl;
        $article['category'] = $category; // Update the category
        $article['created_at'] = date('Y-m-d H:i:s');

        // Write back to the JSON file
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