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
    <html>

    <head>
        <title>Blog Design Panel</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <?php require_once 'layout/header-admin.php'; ?>
    </head>

    <body>
        <?php require_once 'layout/navbar-admin.php'; ?>
        <br /><br/>
        <h1 class="mx-auto" style="text-align: center;color:white;">Blog Design Panel <br /><a href="editor-js.php" class="btn btn-dark"><i class="fa-brands fa-js" style="color: #ffc107;"></i> Custom JS</a> <a href="editor-css.php" class="btn btn-dark"><i class="fa-brands fa-css3" style="color: #ffc107;"></i> Custom CSS</a> <a href="admin-edit.php" class="btn btn-dark"><i class="fa-solid fa-pen-to-square" style="color: #ffc107;"></i> Edit Articles</a> <a href="index.php" class="btn btn-dark"><i class="fa-regular fa-rectangle-list" style="color: #ffc107;"></i> Blog</a></h1>
        <br />
        <div class="container" style="background-color:white;padding:50px;border-radius:10px;">


            <br /><br />
            
            <label for="font_color">
                <h3><i class="fa-solid fa-gear"></i> Font Color:</h3><br />
            </label>
            <input class="form-control" type="color" id="font_color">
            <br />
            <button class="btn btn-outline-dark" onclick="changeFontColor()">Change Color</button><br><br>
            
            <hr/>
            
            <label for="background_color">
                <h3><i class="fa-solid fa-gear"></i> Background Color:</h3><br />
            </label>
            <input class="form-control" type="color" id="background_color">
  
            <br />
            <button class="btn btn-outline-dark" onclick="changeBackgroundColor()">Change Color</button><br><br>
            
            <hr/>
            
            <label for="background_image">
                <h3><i class="fa-solid fa-gear"></i> Background Image URL:</h3><br /> ( Note: Add <b>https://localhost/picture.jpg</b> to disable background image. )<br/> Use transparent images for flexable color schemes.
            </label>
            <input class="form-control" type="text" id="background_image_url" placeholder="URL Goes here...">
            <br />
            <button class="btn btn-outline-dark" onclick="changeBackgroundImage()">Change Image</button><br><br>
            
            <hr/>
            
            <br/>
            <label for="article_background_color">
            <h3><i class="fa-solid fa-gear"></i> Article Background Color:</h3>
            </label><br/>
            <input class="form-control" type="color" id="article_background_color">
            <br/>
            <button class="btn btn-outline-dark" onclick="changeArticleBackgroundColor()">Change Color</button><br><br>

            <hr/>
            
            <br/>
            <label for="article_btn_background_color">
            <h3><i class="fa-solid fa-gear"></i> Article Button Background Color:</h3>
            </label><br/>
            <input class="form-control" type="color" id="article_btn_background_color">
            <br/>
            <button class="btn btn-outline-dark" onclick="changeArticleBtnBackgroundColor()">Change Color</button><br><br>

            <hr/>
            
            <br/>
            <label for="article_btn_font_color">
            <h3><i class="fa-solid fa-gear"></i> Article Button Font Color:</h3>
            </label><br/>
            <input class="form-control" type="color" id="article_btn_font_color">
            <br/>
            <button class="btn btn-outline-dark" onclick="changeArticleBtnFontColor()">Change Color</button><br><br>


        </div>

        <script>

            function changeArticleBtnFontColor() {
                var color = $('#article_btn_font_color').val();
                $.ajax({
                    type: 'POST',
                    url: 'save_changes.php',
                    data: { article_btn_font_color: color },
                    success: function (response) {
                        alert('Font color changed successfully!');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error changing font color:', error);
                    }
                });
            }

            function changeArticleBtnBackgroundColor() {
                var color = $('#article_btn_background_color').val();
                $.ajax({
                    type: 'POST',
                    url: 'save_changes.php',
                    data: { article_btn_background_color: color },
                    success: function (response) {
                        alert('Button Background color changed successfully!');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error changing font color:', error);
                    }
                });
            }

            function changeFontColor() {
                var color = $('#font_color').val();
                $.ajax({
                    type: 'POST',
                    url: 'save_changes.php',
                    data: { fontcolor: color },
                    success: function (response) {
                        alert('Font color changed successfully!');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error changing font color:', error);
                    }
                });
            }


            function changeBackgroundColor() {
                var color = $('#background_color').val();
                $.ajax({
                    type: 'POST',
                    url: 'save_changes.php',
                    data: { background: color },
                    success: function (response) {
                        alert('Background color changed successfully!');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error changing background color:', error);
                    }
                });
            }

            function changeArticleBackgroundColor() {
                var color = $('#article_background_color').val();
                $.ajax({
                    type: 'POST',
                    url: 'save_changes.php',
                    data: { article_background_color: color }, // Use a different key to identify article background color
                    success: function(response) {
                        alert('Article Background color changed successfully!');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error changing article background color:', error);
                    }
                });
            }

            function changeBackgroundImage() {
                var imageUrl = $('#background_image_url').val();
                $.ajax({
                    type: 'POST',
                    url: 'save_changes.php',
                    data: { background_image_url: imageUrl },
                    success: function (response) {
                        alert('Background image changed successfully!');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error changing background image:', error);
                    }
                });
            }
        </script>
    </body>

    </html>