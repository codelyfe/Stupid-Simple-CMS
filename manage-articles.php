<?php
session_start(); /* Starts the session */

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
    <title>Manage Articles</title>
    <style>
        body{
            background: #161616 !important;
            color: white !important;
        }
    </style>
    <?php require_once 'layout/header-admin.php'; ?>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="text-center">
<?php require_once 'layout/body-admin.php'; ?>
    <br /><br />
    <h1 class="my-4">Manage Articles <a href="add-article.php" class="btn btn-dark">Go Back</a></h1>
    
    <div class="container">
        <?php
        $articlesDir = 'blog-posts';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
            $fileToDelete = $_POST['delete'];

            // Validate and sanitize the filename
            $fileToDelete = preg_replace('/[^a-zA-Z0-9_.]/', '', $fileToDelete);

            $filePath = "$articlesDir/$fileToDelete";

            if (file_exists($filePath)) {
                unlink($filePath);
                echo '<div class="alert alert-success">File deleted successfully.</div>';
            } else {
                echo '<div class="alert alert-danger">File not found or could not be deleted.</div>';
            }
        }

        $articleFiles = glob("$articlesDir/*.txt");

        // Sort articles based on file modification time (most recent first)
        usort($articleFiles, function ($a, $b) {
            return filemtime($b) - filemtime($a);
        });

        foreach ($articleFiles as $file) {
            $filename = basename($file);
            ?>
            <div class="article border p-3 text-left mb-3">
                <h4><?php echo $filename; ?></h4>
                <form method="post" action="">
                    <input type="hidden" name="delete" value="<?php echo $filename; ?>">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
            <?php
        }
        ?>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="vendors/bootstrap-5.3.0/bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
</body>
</html>
