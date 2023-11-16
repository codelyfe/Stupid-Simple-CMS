    <?php
    session_start();

    require_once 'vendors/htmlpurifier-4.15.0/HTMLPurifier.auto.php';

    if (!isset($_SESSION['UserData']['Username'])) {
        header("location:login.php");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $imageUrl = $_POST['image_url'];
        $category = $_POST['category']; // Include category

        // Use HTML Purifier to sanitize content, image URL, and category
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        $title = $purifier->purify($title);
        $content = $purifier->purify($content);
        $imageUrl = $purifier->purify($imageUrl);
        $category = $purifier->purify($category);

        // Create a unique filename based on timestamp
        $filename = 'blog-posts/' . time() . '.json';

        // Save the article to the file
        $article = [
            'title' => $title,
            'content' => $content,
            'image_url' => $imageUrl,
            'category' => $category, // Include category in the article
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Check if the file was written successfully
        if (file_put_contents($filename, json_encode($article))) {
            header('Location: add-article.php');
            exit;
        } else {
            $error_message = 'Error saving the article. Please try again.';
        }
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
    <h1 class="mx-auto" style="text-align: center;">Add Article <br /><a href="admin.php" class="btn btn-primary"><i class="fa-solid fa-brush"></i> Design Blog</a> <a href="admin-edit.php" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i> Edit Articles</a> <a href="index.php" class="btn btn-warning">Blog <i class="fa-regular fa-rectangle-list"></i></a></h1>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="add-article.php">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" class="form-control" required>

        <label for="content">Content:</label>
        <textarea id="content" name="content" class="form-control" required></textarea>

        <label for="image_url"><i class="fa-solid fa-image"></i> Image URL:</label>
        <input type="text" id="image_url" name="image_url" class="form-control">

        <label for="category">Category:</label>
        <input type="text" id="category" name="category" class="form-control">

        <button type="submit" class="btn btn-dark">Submit</button>
    </form>

    <!-- Bootstrap JS (optional) -->
    <script src="vendors/bootstrap-5.3.0/bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
    </body>
    </html>
