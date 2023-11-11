<?php 
session_start(); /* Starts the session */

if (!isset($_SESSION['UserData']['Username'])) {
    header("location:login.php");
    exit;
}

// Created by codelyfe 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>(ADMIN) Stupid Simple CMS</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        /* Add your custom styles here if needed */
        body {
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
    <?php require_once 'layout/header-admin.php'; ?>
</head>
<body class="text-center">
<?php require_once 'layout/body-admin.php'; ?>
<br /><br />
    <h1 class="mb-4"><a href="manage-articles.php" class="btn btn-primary">Manage Articles</a>-<a href="add-article.php" class="btn btn-primary">Submit an Article</a>-<a href="index.php" class="btn btn-warning">Blog</a></h1>



    <div class="mx-auto" style="max-width: 800px;">


        <!-- Search Bar -->
        <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search articles" id="searchInputAdmin">
        <button class="btn btn-outline-warning" type="button" id="searchButtonAdmin">Search</button>
        </div>

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
            <div class="article border p-3 text-left" data-article-id="<?php echo $articleId; ?>">
                <h2 class="editable" data-field="title" data-article-id="<?php echo $articleId; ?>">
                    <?php echo $article['title']; ?>
                </h2>

                <?php if (!empty($article['image_url'])) : ?>
                    <img src="<?php echo $article['image_url']; ?>" alt="Article Image" class="img-fluid mb-3">
                <?php endif; ?>

                <p class="editable" data-field="content" data-article-id="<?php echo $articleId; ?>">
                    <?php echo $article['content']; ?>
                </p>
                <p class="text-muted">Created at: <?php echo $article['created_at']; ?></p>
                <button class="btn btn-primary edit-btn" data-article-id="<?php echo $articleId; ?>">Edit</button>
                <button class="btn btn-success save-btn" data-article-id="<?php echo $articleId; ?>" style="display: none;">Save</button>
            </div>
            <?php
        }
        ?>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Custom JavaScript for AJAX editing -->
    <script>
        $(document).ready(function () {
            // Handle search button click
            $("#searchButtonAdmin").on("click", function () {
                var searchTermAdmin = $("#searchInputAdmin").val().toLowerCase();

                // Loop through articles and hide/show based on the search term
                $(".article").each(function () {
                    var articleTextAdmin = $(this).text().toLowerCase();
                    if (articleTextAdmin.includes(searchTermAdmin)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            // Enable editing when the edit button is clicked
            $(".edit-btn").on("click", function () {
                var articleId = $(this).data("article-id");
                enableEditing(articleId);
            });

            // Save changes when the save button is clicked
            $(".save-btn").on("click", function () {
                var articleId = $(this).data("article-id");
                saveChanges(articleId);
            });

            // Function to enable editing for a specific article
            function enableEditing(articleId) {
                $(".editable[data-article-id='" + articleId + "']").attr("contenteditable", "true");
                $(".edit-btn[data-article-id='" + articleId + "']").hide();
                $(".save-btn[data-article-id='" + articleId + "']").show();
            }

            // Function to save changes for a specific article
            function saveChanges(articleId) {
                var title = $(".editable[data-article-id='" + articleId + "'][data-field='title']").text();
                var content = $(".editable[data-article-id='" + articleId + "'][data-field='content']").text();

                // AJAX request to update the article
                $.ajax({
                    url: "update-article.php",
                    type: "POST",
                    data: {
                        id: articleId,
                        title: title,
                        content: content
                    },
                    success: function (response) {
                        // You can handle the response here, e.g., show a success message
                        console.log(response);

                        // Disable editing after saving changes
                        $(".editable[data-article-id='" + articleId + "']").attr("contenteditable", "false");
                        $(".edit-btn[data-article-id='" + articleId + "']").show();
                        $(".save-btn[data-article-id='" + articleId + "']").hide();
                    },
                    error: function (error) {
                        // Handle the error, e.g., show an error message
                        console.error(error);
                    }
                });
            }
        });
    </script>
</body>
</html>
