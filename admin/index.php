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
    <title>General Blog Settings</title>
    <link rel="stylesheet" type="text/css" href="../css/custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php require_once '../layout/header-admin-fm.php'; ?>
</head>
<body>
    <?php require_once '../layout/navbar-admin-fm.php'; ?>
    <br /><br/>
    <h1 class="mx-auto" style="text-align: center;color:white;">General Blog Settings <br /><a href="../terminal/" class="btn btn-dark"><i class="fa-solid fa-code" style="color: #ffc107;"></i> Terminal</a> <a href="../add-article.php" class="btn btn-dark"><i class="fa-solid fa-feather" style="color: #ffc107;"></i> Add Article</a> <a href="../design-blog.php" class="btn btn-dark"><i class="fa-solid fa-brush" style="color: #ffc107;"></i> Design Blog</a> <a href="../editor-js.php" class="btn btn-dark"><i class="fa-brands fa-js" style="color: #ffc107;"></i> Custom JS</a> <a href="../editor-css.php" class="btn btn-dark"><i class="fa-brands fa-css3" style="color: #ffc107;"></i> Custom CSS</a> <a href="../admin-edit.php" class="btn btn-dark"><i class="fa-solid fa-pen-to-square" style="color: #ffc107;"></i> Edit Articles</a> <a href="../index.php" class="btn btn-dark"><i class="fa-regular fa-rectangle-list" style="color: #ffc107;"></i> Blog</a></h1>
    <br />
    

    <div class="container" style="background-color:white;padding:50px;border-radius:10px;">

    <form id="settings-form">
        <label for="site-title">Site Title:</label>
        <input class="form-control" type="text" id="site-title" name="site-title" /><br><br>
        
        <label for="copyright-info">Copyright Url:</label>
        <input class="form-control" type="text" id="copyright-info" name="copyright-info" /><br><br>

        <label for="website-url">Blog Url:</label>
        <input class="form-control" type="text" id="website-url" name="website-url" /><br><br>
        
        <button class="btn btn-dark" type="submit">Save Settings</button>
    </form>

    
    
    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'get_settings.php', // PHP file to retrieve settings from XML
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#site-title').val(data.title);
                    $('#copyright-info').val(data.copyright);
                    $('#website-url').val(data.websiteurl);
                },
                error: function() {
                    console.log('Error fetching settings');
                }
            });
            
            $('#settings-form').submit(function(e) {
                e.preventDefault();
                
                var formData = $(this).serialize();
                
                $.ajax({
                    url: 'save_settings.php', // PHP file to save settings to XML
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log('Settings saved successfully');
                    },
                    error: function() {
                        console.log('Error saving settings');
                    }
                });
            });
        });
    </script>

    </div>

</body>
</html>
