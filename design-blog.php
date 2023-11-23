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
        <h1 class="mx-auto" style="text-align: center;color:white;">Blog Design Panel <br />
        <!--
        <a href="<?php //echo $websiteUrl; ?>terminal/" class="btn btn-dark"><i class="fa-solid fa-code" style="color: #ffc107;"></i> Terminal</a> 
        <a href="<?php //echo $websiteUrl; ?>file-manager/" class="btn btn-dark"><i class="fa-solid fa-folder-open" style="color: #ffc107;"></i> File Manager</a> 
        <a href="<?php //echo $websiteUrl; ?>editor-js.php" class="btn btn-dark"><i class="fa-brands fa-js" style="color: #ffc107;"></i> Custom JS</a> 
        <a href="<?php //echo $websiteUrl; ?>editor-css.php" class="btn btn-dark"><i class="fa-brands fa-css3" style="color: #ffc107;"></i> Custom CSS</a> 
        <a href="<?php //echo $websiteUrl; ?>admin-edit.php" class="btn btn-dark"><i class="fa-solid fa-pen-to-square" style="color: #ffc107;"></i> Edit Articles</a> 
        <a href="<?php //echo $websiteUrl; ?>index.php" class="btn btn-dark"><i class="fa-regular fa-rectangle-list" style="color: #ffc107;"></i> Blog</a>
        -->
        </h1>
        <br />
        <div class="container" style="background-color:white;padding:50px;border-radius:10px;">


            <br /><br />
            
            <?php
            // Path to your XML file
            $xmlFile = 'theme.xml';

            // Load XML file
            $xml = simplexml_load_file($xmlFile);

            if ($xml !== false) {

                // fontcolor
                $fontColor = (string)$xml->fontcolor;
                echo 'Font Color: ' . $fontColor . '<br>';
                


            } else {
                echo 'Failed to load XML file.';
            }
            ?>

            <label for="font_color">
                <h3><i class="fa-solid fa-gear"></i> Font Color ( body ):</h3><br />
            </label>
            <input class="form-control" type="color" id="font_color"  value="<?php echo $fontColor; ?>">
            <br />
            <button class="btn btn-outline-dark" onclick="changeFontColor()">Change Color</button><br><br>
            
            <hr/>

            <?php
            // Path to your XML file
            $xmlFile = 'theme.xml';

            // Load XML file
            $xml = simplexml_load_file($xmlFile);

            if ($xml !== false) {
                // Background Color
                $bgColor = (string)$xml->background;
                echo 'Background: ' . $bgColor . '<br>';



            } else {
                echo 'Failed to load XML file.';
            }
            ?>
            
            <label for="background_color">
                <h3><i class="fa-solid fa-gear"></i> Background Color ( body ):</h3><br />
            </label>
 
      
            <input class="form-control" type="color" id="background_color" name="background_color" value="<?php echo $bgColor; ?>">

  
            <br />
            <button class="btn btn-outline-dark" onclick="changeBackgroundColor()">Change Color</button><br><br>
            
            <hr/>
            
            <?php
            // Path to your XML file
            $xmlFile = 'theme.xml';

            // Load XML file
            $xml = simplexml_load_file($xmlFile);

            if ($xml !== false) {

            // background_image
            $backgroundimage = (string)$xml->background_image;
            //echo 'Background Image: ' . $backgroundimage . '<br>';

            } else {
                echo 'Failed to load XML file.';
            }
            ?>

            <img src="<?php echo $backgroundimage; ?>" width="25%" /><br/><br/>

            <label for="background_image">
                <h3><i class="fa-solid fa-gear"></i> Background Image URL ( body ):</h3><br /> ( Note: Add <b>https://localhost/picture.jpg</b> to disable background image. )<br/> Use transparent images for flexable color schemes.
            </label>
            <input class="form-control" type="text" id="background_image_url" placeholder="<?php echo $backgroundimage; ?>">
            <br />
            <button class="btn btn-outline-dark" onclick="changeBackgroundImage()">Change Image</button><br><br>
            
            <hr/>
            
            <br/>

            <?php
            // Path to your XML file
            $xmlFile = 'theme.xml';

            // Load XML file
            $xml = simplexml_load_file($xmlFile);

            if ($xml !== false) {

                // article_background_color
                $artbgColor = (string)$xml->article_background_color;
                echo 'Article Background Color: ' . $artbgColor . '<br>';


            } else {
                echo 'Failed to load XML file.';
            }
            ?>

            <label for="article_background_color">
            <h3><i class="fa-solid fa-gear"></i> Article Background Color ( .article ):</h3>
            </label><br/>
            <input class="form-control" type="color" id="article_background_color"  value="<?php echo $artbgColor; ?>">
            <br/>
            <button class="btn btn-outline-dark" onclick="changeArticleBackgroundColor()">Change Color</button><br><br>

            <hr/>
            
            <br/>

            <?php
            // Path to your XML file
            $xmlFile = 'theme.xml';

            // Load XML file
            $xml = simplexml_load_file($xmlFile);

            if ($xml !== false) {

            // article_btn_background_color
            $articlebtnbackgroundcolor = (string)$xml->article_btn_background_color;
            echo ' Article Button Background Color: ' . $articlebtnbackgroundcolor . '<br>';


            } else {
                echo 'Failed to load XML file.';
            }
            ?>

            <label for="article_btn_background_color">
            <h3><i class="fa-solid fa-gear"></i> Article Button Background Color ( .article-btn ):</h3>
            </label><br/>
            <input class="form-control" type="color" id="article_btn_background_color"  value="<?php echo $articlebtnbackgroundcolor; ?>">
            <br/>
            <button class="btn btn-outline-dark" onclick="changeArticleBtnBackgroundColor()">Change Color</button><br><br>

            <hr/>
            
            <br/>

            <?php
            // Path to your XML file
            $xmlFile = 'theme.xml';

            // Load XML file
            $xml = simplexml_load_file($xmlFile);

            if ($xml !== false) {

            // Article Button Font Color
            $articlebtnfontcolor = (string)$xml->article_btn_font_color;
            echo 'Article Button Font Color: ' . $articlebtnfontcolor . '<br>';


            } else {
                echo 'Failed to load XML file.';
            }
            ?>


            <label for="article_btn_font_color">
            <h3><i class="fa-solid fa-gear"></i> Article Button Font Color ( .article-btn ):</h3>
            </label><br/>
            <input class="form-control" type="color" id="article_btn_font_color"  value="<?php echo $articlebtnfontcolor; ?>">
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
        <script src="vendors/bootstrap-5.3.0/bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
        <?php require_once 'layout/footer.php'; ?>
    </body>

    </html>