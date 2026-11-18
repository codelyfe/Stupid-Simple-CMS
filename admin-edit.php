    <?php
    /*
    ┏┓┏┓┳┓┏┓┓ ┓┏┏┓┏┓
    ┃ ┃┃┃┃┣ ┃ ┗┫┣ ┣ 
    ┗┛┗┛┻┛┗┛┗┛┗┛┻ ┗┛
    */              
    ?>
    <?php 
    session_start();

    if (!isset($_SESSION['UserData']['Username'])) {
        header("location:login.php");
        exit;
    }
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
    <body class="admin-body">
        <?php require_once 'layout/navbar-admin.php'; ?>
        <main class="admin-page">
        <h1>Articles</h1>
        <p class="admin-lead">Click Edit, change the text in place, then Save. Delete asks before it removes a post.</p>
            <form class="search-bar" onsubmit="return false;" style="margin-bottom:1rem;">
                <input type="text" class="form-control" placeholder="Search articles" id="searchInputAdmin">
                <button type="button" id="searchButtonAdmin"><?php echo $searchbutton; ?></button>
            </form>

            <?php
            require_once __DIR__ . '/includes/store.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
                if (article_delete($_POST['delete'])) {
                    echo '<div class="alert alert-success">Article deleted.</div>';
                } else {
                    echo '<div class="alert alert-danger">Article not found.</div>';
                }
            }

            foreach (articles_all() as $article) {
                $articleId = $article['id'];
                ?>

                <div class="article text-left edit-card" data-article-id="<?php echo $articleId; ?>">
                    <h2 class="editable" data-field="title" data-article-id="<?php echo $articleId; ?>">
                        <?php echo $article['title']; ?>
                    </h2>

                    <p class="mt-2">
                        Category:
                        <span class="editable" data-field="category" data-article-id="<?php echo $articleId; ?>">
                            <?php echo $article['category']; ?>
                        </span>
                    </p>

                    <?php if (!empty($article['image_url'])) : ?>
                        <img src="<?php echo $article['image_url']; ?>" alt="Article Image" class="img-fluid mb-3">
                        <p class="mt-2">
                            Image URL:
                            <span class="editable" data-field="image_url" data-article-id="<?php echo $articleId; ?>">
                                <?php echo $article['image_url']; ?>
                            </span>
                        </p>
                    <?php endif; ?>

                    <p class="editable" data-field="content" data-article-id="<?php echo $articleId; ?>">
                        <?php echo $article['content']; ?>
                    </p>
                    
                    <p class="text-muted">Created at: <?php echo $article['created_at']; ?></p>
                    <div class="article-tools">
                    <button class="admin-save edit-btn" data-article-id="<?php echo $articleId; ?>" type="button">Edit</button>
                    <button class="admin-save save-btn" data-article-id="<?php echo $articleId; ?>" style="display: none;" type="button">Save</button>
                    <form method="post" action="" onsubmit="return confirm('Delete this article?');">
                        <input type="hidden" name="delete" value="<?php echo $articleId; ?>">
                        <button type="submit" class="admin-save" style="background:#8d2b2b;">Delete</button>
                    </form>
                    </div>
                </div>

            <?php
            }
            ?>




        </main>

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
                var title = $(".editable[data-article-id='" + articleId + "'][data-field='title']").text().trim();
                var content = $(".editable[data-article-id='" + articleId + "'][data-field='content']").html().trim(); // Use .html() to preserve formatting
                var imageUrl = $(".editable[data-article-id='" + articleId + "'][data-field='image_url']").text().trim(); // Get the image URL from the editable field
                var category = $(".editable[data-article-id='" + articleId + "'][data-field='category']").text().trim(); // Get the category from the editable field

                // AJAX request to update the article
                $.ajax({
                    url: "update-article.php",
                    type: "POST",
                    data: {
                        id: articleId,
                        title: title,
                        content: content,
                        image_url: imageUrl,
                        category: category // Include the category in the data
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
    <?php require_once 'layout/footer.php'; ?>
    </body>
    </html>
