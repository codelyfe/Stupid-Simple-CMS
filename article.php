    <?php
    /*
    ┏┓┏┓┳┓┏┓┓ ┓┏┏┓┏┓
    ┃ ┃┃┃┃┣ ┃ ┗┫┣ ┣ 
    ┗┛┗┛┻┛┗┛┗┛┗┛┻ ┗┛
    */              
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <?php
        $articlesDir = 'blog-posts';
        $articleId = $_GET['id'] ?? null;

        if ($articleId) {
            $filename = "$articlesDir/$articleId.json";

            if (file_exists($filename)) {
                $content = file_get_contents($filename);
                $article = json_decode($content, true);

                // Set dynamic title and description meta tags
                echo '<title>' . htmlspecialchars($article['title']) . '</title>';
                echo '<meta name="description" content="' . htmlspecialchars(strip_tags($article['content'])) . '">';
                echo '<meta property="og:title" content="' . htmlspecialchars($article['title']) . '">';
                echo '<meta property="og:description" content="' . htmlspecialchars(strip_tags($article['content'])) . '">';
                echo '<meta property="og:image" content="' . htmlspecialchars(strip_tags($article['image_url'])) . '">'; // 
                echo '<meta content="' . htmlspecialchars(strip_tags($article['image_url'])) . '" itemprop="image">';
            }
        }
        ?>

      
     
        

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <script>
    $(document).ready(function() {

      $.ajax({
            type: 'GET',
            url: 'get_content.php',
            data: { element: 'background_image' },
            success: function(response) {
                console.log('Background image URL:', response); // Log received image URL
                $('body').css('background-image', 'url(' + response + ')');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching background image:', error);
            }
        });

        $.ajax({
            type: 'GET',
            url: 'get_content.php',
            data: { element: 'background' },
            success: function(response) {
                $('body').css('background-color', response);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching background color:', error);
            }
        });

        $.ajax({
            type: 'GET',
            url: 'get_content.php',
            data: { element: 'fontcolor' },
            success: function(response) {
                $('body').css('color', response);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching color:', error);
            }
        });

        // Fetch current article background color from XML file
        $.ajax({
                type: 'GET',
                url: 'get_content.php',
                data: {
                    element: 'article_background' // This should match the key in get_content.php
                },
                success: function(response) {
                     console.log('DIV Background Color:', response);
                    // Update the background color of .article elements
                    $('.article').css('background-color', response);
                    
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching content:', error);
                }
            });

        //article-btn
        $.ajax({
                type: 'GET',
                url: 'get_content.php',
                data: {
                    element: 'article_btn_background' // This should match the key in get_content.php
                },
                success: function(response) {
                     console.log('DIV Button Background Color:', response);
                    // Update the background color of .article elements
                    $('.article-btn').css('background-color', response);
                    
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching content:', error);
                }
            });

        //article-btn-font-color
        $.ajax({
                type: 'GET',
                url: 'get_content.php',
                data: {
                    element: 'article_btnfc_background' // This should match the key in get_content.php
                },
                success: function(response) {
                     console.log('DIV Button Font Color:', response);
                    // Update the font color of .article elements
                    $('.article-btn').css('color', response);
                    
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching content:', error);
                }
            });            



    });
    </script>
        <style>
            /* Add your custom styles here if needed */
            body{
                    background-size: cover;
                    background-repeat: no-repeat;
                }

            .article {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                border: 1px solid #ddd;
                border-radius: 8px;
                margin-top: 20px;
            }

            .article img {
                max-width: 100%;
                height: auto;
            }
        </style>
        <?php require_once 'layout/header.php'; ?>
    </head>

    <body>
        <?php require_once 'layout/navbar.php'; ?>
        <?php
        if ($articleId && file_exists($filename)) {
            ?>
            <div class="article border p-3">
                <h2 style="text-align:center !important;">
                    <?php echo $article['title']; ?>
                </h2>

                <?php if (!empty($article['image_url'])): ?>
                    <img src="<?php echo $article['image_url']; ?>" alt="Article Image" class="img-fluid mb-3">
                <?php endif; ?>

                <!-- Display the Category -->
                <?php if (!empty($article['category'])): ?>
                    <p><strong>Category:</strong>
                        <?php echo $article['category']; ?>
                    </p>
                <?php endif; ?>

                <p>
                    <?php echo $article['content']; ?>
                </p>
                <p class="text-muted">Created at:
                    <?php echo $article['created_at']; ?>
                </p>

                <?php
                $currentURL = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                $qrurl = 'https://chart.googleapis.com/chart?cht=qr&chl=http%3A%2F%2F';
                $rssurl = htmlspecialchars($currentURL);
                $are7 = '80x80';
                echo '<img src="'.$qrurl.''.$rssurl.'&chs='.$are7.'&choe=UTF-8&chld=L|2" alt="">';
                ?> 

                <!-- Social Buttons-->
                <!--<a class="btn btn btn-secondary" style="text-decoration: none;box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0), 0 1px 2px rgba(0, 0, 0, 0);border: 1px solid rgba(204, 204, 204, 0);border-bottom-color: rgba(179, 179, 179, 0);background-color: rgba(245, 245, 245, 0);background-image: linear-gradient(to bottom,rgba(255, 255, 255, 0),rgba(230, 230, 230, 0));" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php //echo $websiteUrl; ?>article.php?id=<?php //echo $articleId; ?>&title=<?php //echo $article['title']; ?>" target="_blank"><i class="fa-brands fa-linkedin" style="color:black;font-size:30px;"></i></a>-->
                <a class="btn btn-secondary" style="text-decoration: none;box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0), 0 1px 2px rgba(0, 0, 0, 0);border: 1px solid rgba(204, 204, 204, 0);border-bottom-color: rgba(179, 179, 179, 0);background-color: rgba(245, 245, 245, 0);background-image: linear-gradient(to bottom,rgba(255, 255, 255, 0),rgba(230, 230, 230, 0));" href="https://www.facebook.com/sharer/sharer.php?app_id=113869198637480&sdk=joey&title=<?php echo $article['title']; ?>&u=<?php echo $websiteUrl; ?>article.php?id=<?php echo $articleId; ?>" target="_blank"><i class="fa-brands fa-square-facebook" style="color:black;font-size:30px;"></i></a>
                <a class="btn btn-secondary" style="text-decoration: none;box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0), 0 1px 2px rgba(0, 0, 0, 0);border: 1px solid rgba(204, 204, 204, 0);border-bottom-color: rgba(179, 179, 179, 0);background-color: rgba(245, 245, 245, 0);background-image: linear-gradient(to bottom,rgba(255, 255, 255, 0),rgba(230, 230, 230, 0));" href="https://trello.com/add-card?mode=popup&url=<?php echo $websiteUrl; ?>article.php?id=<?php echo $articleId; ?>&name=<?php echo $article['title']; ?>&desc=<?php echo $websiteUrl; ?>article.php?id=<?php echo $articleId; ?>" target="_blank"><i class="fa-brands fa-trello" style="color:black;font-size:30px;"></i></a>
                <!-- Social Buttons-->                    

                <!-- Go Back Button -->
                <a href="index.php" class="btn article-btn" style="float:right;">
                    <?php echo $goback; ?>
                </a>
                <br /><br />
            </div>
            <?php
        } else {
            echo '<div class="alert alert-danger">Article not found.</div>';
        }
        ?>

        <!-- Bootstrap JS (optional) -->
        <script src="vendors/bootstrap-5.3.0/bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
        <?php require_once 'layout/footer.php'; ?>
    </body>

    </html>