    <?php
    /*
    ┏┓┏┓┳┓┏┓┓ ┓┏┏┓┏┓
    ┃ ┃┃┃┃┣ ┃ ┗┫┣ ┣ 
    ┗┛┗┛┻┛┗┛┗┛┗┛┻ ┗┛
    */              
    ?>
    <?php
    session_start();

    require_once 'vendors/htmlpurifier-4.15.0/HTMLPurifier.auto.php';

    if (!isset($_SESSION['UserData']['Username'])) {
        header("location:login.php");
        exit;
    }

    $username = $_SESSION['UserData']['Username'];

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
        require_once __DIR__ . '/includes/store.php';
        if (article_create($title, $content, $imageUrl, $category)) {
            header('Location: add-article.php?saved=1');
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
    <body class="admin-body">
    <?php require_once 'layout/navbar-admin.php'; ?>
    <main class="admin-page">
    <h1>Write</h1>
    <p class="admin-lead">Welcome, <?php echo htmlspecialchars($username); ?>. Publish a post, then it shows up under Articles.</p>
    <?php if (!empty($_GET['saved'])): ?>
        <p class="admin-lead">Published. <a href="admin-edit.php">Open it in Articles</a>.</p>
    <?php endif; ?>
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger" role="alert"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form class="admin-panel" method="post" action="add-article.php">
        <label for="title">Title:</label>
        <input placeholder="Interesting Title" type="text" id="title" name="title" class="form-control" required>

        <label for="content">Content:</label>
        <textarea placeholder="What story can we share?" id="content" name="content" class="form-control" required></textarea>

        <label for="image_url"><i class="fa-solid fa-image"></i> Image URL ( JPG, GIF, PNG ): Save on space and bandwidth by using a <br/>
        ( 3rd Party ) <a href="https://imgbb.com" style="color: var(--bs-yellow);text-decoration: none;font-weight: 500;" target="_blank">Upload Images Here</a>
        <br /> or use <a href="./file-manager/" style="color: var(--bs-yellow);text-decoration: none;font-weight: 500;" target="_blank">file manager</a> to upload images and copy url into your post. 
        </label>
        <input type="text" id="image_url" name="image_url" class="form-control" placeholder="https://i.ibb.co/D8ZdBrd/bear-8364583-1280.png">

        <label for="category">Category:</label>
        <input placeholder="News" type="text" id="category" name="category" class="form-control">

        <button type="submit" class="admin-save">Publish</button>
    </form>
    </main>

    <!-- Bootstrap JS (optional) -->
    <script src="vendors/bootstrap-5.3.0/bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
    <?php require_once 'layout/footer.php'; ?>
    </body>
    </html>