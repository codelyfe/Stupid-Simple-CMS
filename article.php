<?php // Created by codelyfe ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    $articlesDir = 'blog-posts';
    $articleId = $_GET['id'] ?? null;

    if ($articleId) {
        $filename = "$articlesDir/$articleId.json";

        if (file_exists($filename)) {
            $content = file_get_contents($filename);
            $article = json_decode($content, true);

            // Set dynamic title and description meta tags
            echo '<title>' . htmlspecialchars($article['title']) . '</title>';
            echo '<meta name="description" content="' . htmlspecialchars(strip_tags($article['content'])) . '">';
        }
    }
    ?>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        /* Add your custom styles here if needed */
        body {
            padding: 20px;
            background: #161616;
           
        }

        .article {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-top: 20px;
        }

        .article img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

    <?php
    if ($articleId && file_exists($filename)) {
        ?>
        <div class="article border p-3">
            <h2><?php echo $article['title']; ?></h2>

            <?php if (!empty($article['image_url'])) : ?>
                <img src="<?php echo $article['image_url']; ?>" alt="Article Image" class="img-fluid mb-3">
            <?php endif; ?>

            <p><?php echo $article['content']; ?></p>
            <p class="text-muted">Created at: <?php echo $article['created_at']; ?></p>

            <!-- Go Back Button -->
            <a href="index.php" class="btn btn-primary">Go Back</a>
        </div>
        <?php
    } else {
        echo '<div class="alert alert-danger">Article not found.</div>';
    }
    ?>

    <!-- Bootstrap JS (optional) -->
    <script src="vendors/bootstrap-5.3.0/bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
</body>
</html>
