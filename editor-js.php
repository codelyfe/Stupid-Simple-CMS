<?php 
    session_start();

    if (!isset($_SESSION['UserData']['Username'])) {
        header("location:login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>CSS Editor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php require_once 'layout/header-admin.php'; ?>
</head>
<body>
<?php require_once 'layout/navbar-admin.php'; ?>
<br/><br/>
<h1 class="mx-auto" style="text-align: center; color:white;">Custom <i class="fa-brands fa-js" style="color: #ffc107;"></i><br /><a href="add-article.php" class="btn btn-dark"><i class="fa-solid fa-feather" style="color: #ffc107;"></i> Add Article</a> <a href="design-blog.php" class="btn btn-dark"><i class="fa-solid fa-brush" style="color: #ffc107;"></i> Design Blog</a> <a href="admin-edit.php" class="btn btn-dark"><i class="fa-solid fa-pen-to-square" style="color: #ffc107;"></i> Edit Articles</a> <a href="index.php" class="btn btn-dark"><i class="fa-regular fa-rectangle-list" style="color: #ffc107;"></i> Blog</a></h1>
<br/>
<div class="container" style="background:white;padding:50px;border-radius:10px;">

<?php
$filePath = 'js/custom.js'; // Path to your JS file

if (file_exists($filePath)) {
    $jsContent = file_get_contents($filePath);
} else {
    $jsContent = ''; // Default JS content if custom.js doesn't exist
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['js_content'])) {
    // Update $jsContent if the form is submitted
    $jsContent = $_POST['js_content'];

    // Save the updated JS content to custom.js
    file_put_contents($filePath, $jsContent);
}
?>

<form method="post" action="">
    <textarea class="form-control" name="js_content" rows="10" cols="50"><?php echo $jsContent; ?></textarea>
    <br>
    <input class="form-control" type="submit" value="Save  JavaScript">
</form>

</div>
<?php require_once 'layout/footer.php'; ?>
</body>
</html>