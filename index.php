<?php // Created by codelyfe ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stupid Simple CMS</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        /* Add your custom styles here if needed */
        body {
            padding: 20px;
            background: #161616;
            color: white;
        }

        .article {
            margin-bottom: 20px;
            background: white;
            color: black;
            border-radius: 10px;
        }
    </style>
</head>
<body class="text-center"> <!-- Add text-center class to the body -->

    <h1 class="mb-4">Stupid Simple CMS <a class="btn btn-dark" href="add-article.php">Add Article</a></h1>
    <div class="mx-auto" style="max-width: 800px;"> <!-- Add mx-auto class and set max-width -->
        <?php
        $articlesDir = 'blog-posts';

        // Fetch articles from the directory
        $articleFiles = glob("$articlesDir/*.txt");

        // Sort articles based on file modification time (most recent first)
        usort($articleFiles, function ($a, $b) {
            return filemtime($b) - filemtime($a);
        });

        foreach ($articleFiles as $file) {
            $content = file_get_contents($file);
            $article = json_decode($content, true);
            $articleId = pathinfo($file, PATHINFO_FILENAME); // Extract article ID from filename
            ?>
            <div class="article border p-3 text-left"> <!-- Add text-left class to the article container -->
                <h2>
                    <a href="article.php?id=<?php echo $articleId; ?>"><?php echo $article['title']; ?></a>
                </h2>

                <?php if (!empty($article['image_url'])) : ?>
                    <img src="<?php echo $article['image_url']; ?>" alt="Article Image" class="img-fluid mb-3">
                <?php endif; ?>

                <p><?php echo $article['content']; ?></p>
                <p class="text-muted">Created at: <?php echo $article['created_at']; ?></p>
            </div>
            <?php
        }
        ?>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
