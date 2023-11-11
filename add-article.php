<?php // Created by codelyfe ?>
<?php
session_start(); /* Starts the session */

// Include HTML Purifier
require_once 'vendors/htmlpurifier-4.15.0/HTMLPurifier.auto.php';

if (!isset($_SESSION['UserData']['Username'])) {
    header("location:login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $imageUrl = $_POST['image_url']; // New input field for image URL

    // Create a unique filename based on timestamp
    $filename = 'blog-posts/' . time() . '.txt';

    // Use HTML Purifier to sanitize content
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $content = $purifier->purify($content);

    // Save the article to the file
    $article = [
        'title' => $title,
        'content' => $content,
        'image_url' => $imageUrl, // Save the image URL
        'created_at' => date('Y-m-d H:i:s'),
    ];

    file_put_contents($filename, json_encode($article));

    header('Location: add-article.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Article</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        /* Add your custom styles here if needed */
        body {
            background: #161616;
            color: white;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            margin-top: 10px;
            display: block;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            display: inline-block;
            box-sizing: border-box;
        }
    </style>
    <?php require_once 'layout/header-admin.php'; ?>
</head>
<body>
<?php require_once 'layout/body-admin.php'; ?>
<br /><br />
    <h1 class="mx-auto" style="text-align: center;">Add Article <a  class="btn btn-danger" href="logout.php">Logout</a>-<a href="manage-articles.php" class="btn btn-dark">Manage Articles</a>-<a href="index.php" class="btn btn-dark">Go Back</a>-<a href="admin-edit.php" class="btn btn-dark">Admin Edit</a></h1>

    <form method="post" action="add-article.php">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" class="form-control" required>

        <label for="content">Content:</label>
        <textarea id="content" name="content" class="form-control" required></textarea>

        <label for="image_url">Image URL:</label> <!-- New input field for image URL -->
        <input type="text" id="image_url" name="image_url" class="form-control">

        <button type="submit" class="btn btn-dark">Submit</button>
    </form>

    

    <!-- Bootstrap JS (optional) -->
    <script src="vendors/bootstrap-5.3.0/bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>


    

</body>
</html>
