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

    <body class="admin-body">
        <?php require_once 'layout/navbar-admin.php'; ?>
        <main class="admin-page">
        <h1>Design</h1>
        <p class="admin-lead">Colors and the background image. Custom CSS and JS live under this section.</p>
        <p class="admin-lead"><a href="editor-css.php">Custom CSS</a> · <a href="editor-js.php">Custom JS</a></p>
        <h1 class="mx-auto" style="display:none;">
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
        <div class="admin-panel">
            <?php
            require_once __DIR__ . '/includes/store.php';
            $accent = setting('accent', '#c45c26');
            $navColor = setting('nav_color', '#101216');
            $headingColor = setting('heading_color', '#14181f');
            $cardRadius = setting('card_radius', '18');
            $overlay = setting('overlay', '72');
            $typeface = setting('typeface', 'fraunces');
            $contentWidth = setting('content_width', '760');
            $imageHeight = setting('image_height', '320');
            ?>
            <h2>Look</h2>
            <p class="hint">Start from a preset, then adjust type, width, photos, and color.</p>
            <div class="article-tools" style="margin-bottom:0.8rem;">
              <button class="admin-save" type="button" onclick="applyPreset('paper')">Paper</button>
              <button class="admin-save" type="button" onclick="applyPreset('night')">Night</button>
              <button class="admin-save" type="button" onclick="applyPreset('coast')">Coast</button>
              <button class="admin-save" type="button" onclick="applyPreset('ink')">Ink</button>
            </div>
            <label for="typeface">Title type</label>
            <select class="form-control" id="typeface">
              <option value="fraunces" <?php if ($typeface === 'fraunces') echo 'selected'; ?>>Fraunces</option>
              <option value="newsreader" <?php if ($typeface === 'newsreader') echo 'selected'; ?>>Newsreader</option>
              <option value="libre" <?php if ($typeface === 'libre') echo 'selected'; ?>>Libre Baskerville</option>
            </select>
            <label for="content_width">Column</label>
            <select class="form-control" id="content_width">
              <option value="640" <?php if ($contentWidth === '640') echo 'selected'; ?>>Narrow</option>
              <option value="760" <?php if ($contentWidth === '760') echo 'selected'; ?>>Reading</option>
              <option value="980" <?php if ($contentWidth === '980') echo 'selected'; ?>>Wide</option>
            </select>
            <label for="image_height">Photo crop</label>
            <select class="form-control" id="image_height">
              <option value="180" <?php if ($imageHeight === '180') echo 'selected'; ?>>Short</option>
              <option value="320" <?php if ($imageHeight === '320') echo 'selected'; ?>>Medium</option>
              <option value="460" <?php if ($imageHeight === '460') echo 'selected'; ?>>Tall</option>
            </select>
            <label for="accent">Accent</label>
            <input class="form-control" type="color" id="accent" value="<?php echo htmlspecialchars($accent); ?>">
            <label for="nav_color">Navigation bar</label>
            <input class="form-control" type="color" id="nav_color" value="<?php echo htmlspecialchars($navColor); ?>">
            <label for="heading_color">Article titles</label>
            <input class="form-control" type="color" id="heading_color" value="<?php echo htmlspecialchars($headingColor); ?>">
            <label for="card_radius">Card roundness <span class="hint" id="radius-readout"><?php echo htmlspecialchars($cardRadius); ?>px</span></label>
            <input class="form-control" type="range" id="card_radius" min="0" max="36" value="<?php echo htmlspecialchars($cardRadius); ?>">
            <label for="overlay">Photo veil <span class="hint" id="overlay-readout"><?php echo htmlspecialchars($overlay); ?>%</span></label>
            <input class="form-control" type="range" id="overlay" min="0" max="90" value="<?php echo htmlspecialchars($overlay); ?>">
            <button class="admin-save" type="button" onclick="saveLook()">Save look</button>
            <hr/>


            <br /><br />
            
            <?php
            // Path to your XML file
            $xmlFile = 'theme.xml';

            // Load XML file
            require_once __DIR__ . '/includes/store.php';
            $xml = theme_bag();

            if ($xml !== false) {

                // fontcolor
                $fontColor = (string)$xml->fontcolor;
                echo '<span class="badge bg-dark" style="float: right;padding: 12px;margin-bottom: 20px;">Font Color: <span style="color:#ffc107;">' . $fontColor . '</span></span><br>';
                


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
            require_once __DIR__ . '/includes/store.php';
            $xml = theme_bag();

            if ($xml !== false) {
                // Background Color
                $bgColor = (string)$xml->background;
                echo '<span class="badge bg-dark" style="float: right;padding: 12px;margin-bottom: 20px;">Background: <span style="color:#ffc107;">' . $bgColor . '</span></span><br>';



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
            require_once __DIR__ . '/includes/store.php';
            $xml = theme_bag();

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
            require_once __DIR__ . '/includes/store.php';
            $xml = theme_bag();

            if ($xml !== false) {

                // article_background_color
                $artbgColor = (string)$xml->article_background_color;
                echo '<span class="badge bg-dark" style="float: right;padding: 12px;margin-bottom: 20px;">Article Background Color: <span style="color:#ffc107;">' . $artbgColor . '</span></span><br>';


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
            require_once __DIR__ . '/includes/store.php';
            $xml = theme_bag();

            if ($xml !== false) {

            // article_btn_background_color
            $articlebtnbackgroundcolor = (string)$xml->article_btn_background_color;
            echo '<span class="badge bg-dark" style="float: right;padding: 12px;margin-bottom: 20px;">Article Button Background Color: <span style="color:#ffc107;">' . $articlebtnbackgroundcolor . '</span></span><br>';


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
            require_once __DIR__ . '/includes/store.php';
            $xml = theme_bag();

            if ($xml !== false) {

            // Article Button Font Color
            $articlebtnfontcolor = (string)$xml->article_btn_font_color;
            echo '<span class="badge bg-dark" style="float: right;padding: 12px;margin-bottom: 20px;">Article Button Font Color: <span style="color:#ffc107;">' . $articlebtnfontcolor . '</span></span><br>';


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

            function lookData() {
                return {
                    accent: $('#accent').val(),
                    nav_color: $('#nav_color').val(),
                    heading_color: $('#heading_color').val(),
                    card_radius: $('#card_radius').val(),
                    overlay: $('#overlay').val(),
                    typeface: $('#typeface').val(),
                    content_width: $('#content_width').val(),
                    image_height: $('#image_height').val()
                };
            }
            function saveLook() {
                $.ajax({
                    type: 'POST',
                    url: 'save_changes.php',
                    data: lookData(),
                    success: function () { alert('Look saved.'); }
                });
            }
            var presets = {
                paper: { accent:'#c45c26', nav_color:'#101216', heading_color:'#14181f', card_radius:18, overlay:72, typeface:'fraunces', content_width:'760', image_height:'320', fontcolor:'#14181f', background:'#1c1c1c', article_background_color:'#fffdf8', article_btn_background_color:'#14181f', article_btn_font_color:'#ffffff' },
                night: { accent:'#d4a017', nav_color:'#07080b', heading_color:'#f4efe6', card_radius:8, overlay:82, typeface:'newsreader', content_width:'640', image_height:'180', fontcolor:'#f4efe6', background:'#07080b', article_background_color:'#171a21', article_btn_background_color:'#d4a017', article_btn_font_color:'#171a21' },
                coast: { accent:'#1f6f8b', nav_color:'#0e2430', heading_color:'#14323c', card_radius:28, overlay:45, typeface:'libre', content_width:'760', image_height:'320', fontcolor:'#14323c', background:'#d7e6ea', article_background_color:'#f7fbfc', article_btn_background_color:'#1f6f8b', article_btn_font_color:'#ffffff' },
                ink: { accent:'#f2f2f2', nav_color:'#111111', heading_color:'#111111', card_radius:0, overlay:20, typeface:'libre', content_width:'980', image_height:'460', fontcolor:'#111111', background:'#f4f1ea', article_background_color:'#ffffff', article_btn_background_color:'#111111', article_btn_font_color:'#ffffff' }
            };
            function applyPreset(name) {
                var p = presets[name];
                if (!p) return;
                $('#accent').val(p.accent);
                $('#nav_color').val(p.nav_color);
                $('#heading_color').val(p.heading_color);
                $('#card_radius').val(p.card_radius);
                $('#overlay').val(p.overlay);
                $('#typeface').val(p.typeface);
                $('#content_width').val(p.content_width);
                $('#image_height').val(p.image_height);
                $('#radius-readout').text(p.card_radius + 'px');
                $('#overlay-readout').text(p.overlay + '%');
                $.ajax({ type:'POST', url:'save_changes.php', data:p, success:function(){ alert(name + ' applied.'); } });
            }
            $('#card_radius').on('input', function () { $('#radius-readout').text(this.value + 'px'); });
            $('#overlay').on('input', function () { $('#overlay-readout').text(this.value + '%'); });

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
        </main>
        <?php require_once 'layout/footer.php'; ?>
    </body>

    </html>