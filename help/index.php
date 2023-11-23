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
        header("location:../login.php");
        exit;
    }
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Help Desk</title>
    <link rel="stylesheet" type="text/css" href="../css/custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php require_once '../layout/header-admin-fm.php'; ?>
</head>
<body>
<?php require_once '../layout/navbar-admin-fm.php'; ?>
<br /><br/>
<h1 class="mx-auto" style="text-align: center;color:white;">Need Help<i class="fa-solid fa-question" style="color: #ffc107;"></i> <br />
<!--
<a href="<?php //echo $websiteUrl; ?>terminal/" class="btn btn-dark"><i class="fa-solid fa-code" style="color: #ffc107;"></i> Terminal</a> 
<a href="<?php //echo $websiteUrl; ?>add-article.php" class="btn btn-dark"><i class="fa-solid fa-feather" style="color: #ffc107;"></i> Add Article</a> 
<a href="<?php //echo $websiteUrl; ?>design-blog.php" class="btn btn-dark"><i class="fa-solid fa-brush" style="color: #ffc107;"></i> Design Blog</a> 
<a href="<?php //echo $websiteUrl; ?>editor-js.php" class="btn btn-dark"><i class="fa-brands fa-js" style="color: #ffc107;"></i> Custom JS</a> 
<a href="<?php //echo $websiteUrl; ?>editor-css.php" class="btn btn-dark"><i class="fa-brands fa-css3" style="color: #ffc107;"></i> Custom CSS</a> 
<a href="<?php //echo $websiteUrl; ?>admin-edit.php" class="btn btn-dark"><i class="fa-solid fa-pen-to-square" style="color: #ffc107;"></i> Edit Articles</a> 
<a href="<?php //echo $websiteUrl; ?>index.php" class="btn btn-dark"><i class="fa-regular fa-rectangle-list" style="color: #ffc107;"></i> Blog</a>
-->
</h1>

<br />

    <div class="container" style="background-color:white;padding:50px;border-radius:10px;">


        <div class="row">
            <div class="col">
                
                    <form style="padding-top: 70px;" data-bss-recipient="3880bf3f1a582d89bf30ba7f2503f3a1">
                        <div class="form-group mb-3">
                            <h1 class="text-center">Contact Stupid Simple CMS</h1>
                        </div>
                        <div class="form-group mb-3"><input class="form-control form-control-lg" type="text" style="width: 50%;margin-left: 25%;" required="" placeholder="Name"></div>
                        <div class="form-group mb-3"><input class="form-control form-control-lg" type="email" style="width: 50%;margin-left: 25%;" placeholder="Email"></div>
                        <div class="form-group mb-3"><textarea class="form-control form-control-lg" style="width: 50%;margin-left: 25%;min-height: 200px;" placeholder="Message"></textarea></div>
                        <div class="form-group mb-3"><button class="btn btn-dark btn-lg" style="width: 50%;margin-left: 25%;" type="submit">Contact us</button></div>
                    </form>
                
            </div>
        </div>

    </div>
   
    <script src="assets/js/smart-forms.min.js"></script>





    <?php require_once '../layout/footer.php'; ?>
</body>
</html>