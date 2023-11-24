<?php
/*
┏┓┏┓┳┓┏┓┓ ┓┏┏┓┏┓
┃ ┃┃┃┃┣ ┃ ┗┫┣ ┣ 
┗┛┗┛┻┛┗┛┗┛┗┛┻ ┗┛
*/              
?>
<?php
// Path to your XML file
$xmlFile = 'admin/site-settings.xml';

// Load XML file
$xml = simplexml_load_file($xmlFile);

if ($xml !== false) {
$siteTitle = (string)$xml->title;
$siteCopyright = (string)$xml->copyright;
$websiteUrl = (string)$xml->websiteurl;
$metatxtdesc = (string)$xml->metatxtdesc;
$metaimg = (string)$xml->metaimg;

$currentYear = date('Y');
} 
else {
 echo 'Failed to load XML file.';
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
     echo '<meta name="description" content="' . $metatxtdesc . '">';
     echo '<meta property="og:title" content="' . $siteTitle . '">';
     echo '<meta property="og:description" content="' . $metatxtdesc . '">';
     echo '<meta property="og:image" content="' . $metaimg . '">'; 
     echo '<meta content="' . $metaimg . '" itemprop="image">';
    ?>

    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
      body{
        background-size: cover;
        background-repeat: no-repeat;
      }
    </style>
    
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
    /**********************************************************************/
    /*********************** START OF CSS *********************************/
    /**********************************************************************/
    /*--------------------------------------------------------------------*/
    /**********************************************************************/
    /*********************** MAIN PAGE CSS ********************************/
    /**********************************************************************/

    /**********************************************************************/
    /********************** TOGGLE FUNCTION CSS ***************************/
    /**********************************************************************/
    .img-hide{
        display:none !important;
    }
    .video-hide{
        display:none !important;
    }
    .dark-mode {
        background-color: black !important;
        color: white !important;
    }
    .large-text {
        font-size:2em !important;
    }
    .large-image{
      width:700px !important;
    }
    .read-font-text {
        font-family: 'Courier New', Courier, monospace !important;
    }
    .outline-title{
        outline-style: solid !important;
        outline-color: rgb(249, 99, 99) !important;
        outline-width: 2px !important;
        outline-offset: 2px !important;
        width: fit-content !important;
    }
    .outline-links{
        color:red !important;
        outline-style: solid !important;
        outline-color: rgb(249, 99, 132) !important;
        outline-width: 2px !important;
        outline-offset: 2px !important;
        width: fit-content !important;
        border-radius:2px !important;
        padding:1px !important;
    }

    .colorblind-text{
      color:black !important;
      background-color: white !important;
    }
    .center-text{
      text-align: center !important;
    }
    .right-text{
      text-align: right !important;
    }
    .left-text{
      text-align: left !important;
    }
    .book-mode{
      background-color: #e1dcbe !important;
    }
    .dark-span{
      color: #000 !important;
    }
    .div-hide{
      background-color: #000 !important;
      color: #fff !important;
    }
    .div-hide-book{
      background-color: rgba(255, 255, 255, 0) !important;
      color: rgb(0, 0, 0) !important;
    }    
    .div-hide2{
      background-color: #fff !important;
      color: #000 !important;
    }
    .a-hide{
      background-color: #000 !important;
      color: #fff !important;
    }
    .a-hide2{
      background-color: #fff0 !important;
      color: #000 !important;
      border: none;
    }
    /* Text To Speech*/
    #play {
      background-image: url(https://rpsthecoder.github.io/js-speech-synthesis/play.svg) !important;
      padding:16px !important;
      background-color: #fff !important;
      border: none !important;
      border-radius: 100px;
    }

    #play.played {
      background-image: url(https://rpsthecoder.github.io/js-speech-synthesis/play1.svg) !important;
      padding:16px !important;
      background-color: #fff !important;
      border: none !important;
      border-radius: 100px;
    }

    #pause {
      background-image: url(https://rpsthecoder.github.io/js-speech-synthesis/pause.svg) !important;
      padding:16px !important;
      background-color: #fff !important;
      border: none !important;
      border-radius: 100px;
    }

    #pause.paused {
      background-image: url(https://rpsthecoder.github.io/js-speech-synthesis/pause1.svg);
      padding:16px;
      background-color: #fff !important;
      border: none;
      border-radius: 100px;
    }

    #stop {
      background-image: url(https://rpsthecoder.github.io/js-speech-synthesis/stop.svg);
      padding:16px;
      background-color: #fff !important;
      border: none;
      border-radius: 100px;
    }

    #stop.stopped {
      background-image: url(https://rpsthecoder.github.io/js-speech-synthesis/stop1.svg);
      padding:16px;
      background-color: #fff !important;
      border: none;
      border-radius: 100px;
    }

    
    /**********************************************************************/
    /****************** Toggle Switches / Buttons *************************/
    /**********************************************************************/

    /**/
    button{
        background-color: black;
        color:white;
        padding:5px;
    }
    /**/
    .switch {
      position: relative !important;
      display: inline-block !important;
      width: 60px !important;
      height: 34px !important;
      margin-left: 10px !important;
      }

    .switch input { 
      opacity: 0 !important;
      width: 0 !important;
      height: 0 !important;

    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0 !important;
      left: 0 !important;
      right: 0 !important;
      bottom: 0 !important;
      background-color: #ccc !important;
      -webkit-transition: .4s !important;
      transition: .4s !important;
    }

    .slider:before {
      position: absolute !important;
      content: "" !important;
      height: 26px !important;
      width: 26px !important;
      left: 4px !important;
      bottom: 4px !important;
      background-color: white !important;
      -webkit-transition: .4s !important;
      transition: .4s !important;
    }

    input:checked + .slider {
      background-color: #2196F3 !important;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3 !important;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px) !important;
      -ms-transform: translateX(26px) !important;
      transform: translateX(26px) !important;
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px !important;
    }

    .slider.round:before {
      border-radius: 50% !important;
    }
    /**********************************************************************/
    /********** Toggle 3rd Side Nav For Toggle Functions ******************/
    /**********************************************************************/
    .sidenav2 {
        height: 100% !important;
        width: 0;
        position: fixed !important;
        z-index: -1 !important;
        top: 0 !important;
        right: 0 !important;
        background-color: #fff;
        overflow-x:hidden;
        overflow-y:auto;
        transition: 0.5s !important;
        padding-top: 60px !important;

    }
    .sidenav2 a {
      padding: 8px 8px 8px 32px !important;
      text-decoration: none !important;
      font-size: 25px !important;
      color: #818181 !important;
      display: block !important;
      transition: 0.3s !important;
    }

    .sidenav2 a:hover {
      color: #f1f1f1 !important;
    }

    .sidenav2 .closebtn2 {
      position: absolute !important;
      top: 0 !important;
      right: 238px !important;
      font-size: 36px !important;
      margin-left: 50px !important;
    }

    @media screen and (max-height: 450px) {
      .sidenav2 {padding-top: 15px !important;}
      .sidenav2 a {font-size: 18px !important;}
    }
    /**********************************************************************/
    /********** Toggle 2nd Side Nav For Toggle Functions ******************/
    /**********************************************************************/
    .sidenav1 {
        height: 100% !important;
        width: 0;
        position: fixed !important;
        z-index: 2 !important;
        top: 0 !important;
        right: 0 !important;
        background-color: #fff;
        overflow-y:auto;
        transition: 0.5s !important;
        padding-top: 60px !important;

    }
    .sidenav1 a {
      padding: 8px 8px 8px 32px !important;
      text-decoration: none !important;
      font-size: 25px !important;
      color: #818181 !important;
      display: block !important;
      transition: 0.3s !important;
    }

    .sidenav1 a:hover {
      color: #f1f1f1 !important;
    }

    .sidenav1 .closebtn {
      position: absolute !important;
      top: 0 !important;
      right: 138px !important;
      font-size: 36px !important;
      margin-left: 50px !important;
    }

    @media screen and (max-height: 450px) {
      .sidenav1 {padding-top: 15px !important;}
      .sidenav1 a {font-size: 18px !important;}
    }
    /**********************************************************************/
    /********** Toggle 1st Side Nav For Toggle Functions ******************/
    /**********************************************************************/
    .sidenav {
      height: 100% !important;
      width: 0;
      position: fixed !important;
      z-index: 3 !important;
      top: 0 !important;
      right: 0 !important;
      background-color: #000;
      overflow-y:auto;
      transition: 0.5s !important;
      padding-top: 60px !important;
    
    }

    .sidenav a {
      padding: 8px 8px 8px 32px !important;
      text-decoration: none !important;
      font-size: 25px !important;
      color: #818181 !important;
      display: block !important;
      transition: 0.3s !important;
    }

    .sidenav a:hover {
      color: #f1f1f1 !important;
    }

    .sidenav .closebtn {
      position: absolute !important;
      top: 0 !important;
      right: 25px !important;
      font-size: 36px !important;
      margin-left: 50px !important;
    }

    @media screen and (max-height: 450px) {
      .sidenav {padding-top: 15px !important;}
      .sidenav a {font-size: 18px !important;}
    }
    /**********************************************************************/
    /************************* END OF CSS *********************************/
    /**********************************************************************/
  </style>
      <style>
        /* Add your custom styles here if needed 
        body {
            background: #161616;
            color: white;
        }*/

        .article {
            margin-bottom: 20px;
            /*background: white;*/
            /*color: black;*/
            border-radius: 10px;
        }
    </style>
    <?php require_once 'layout/header.php'; ?>
</head>
  <body>







  <!--/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\-->

  <!--
 
  ███████ ████████  █████  ██████  ████████ 
  ██         ██    ██   ██ ██   ██    ██    
  ███████    ██    ███████ ██████     ██    
       ██    ██    ██   ██ ██   ██    ██    
  ███████    ██    ██   ██ ██   ██    ██    
                                                                                    
  -->

<!--| TEST CONTENT BELOW THIS LINE |-->
<?php require_once 'layout/navbar.php'; ?>
<br /><br />

<div class="mx-auto" style="max-width: 800px;"> <!-- Add mx-auto class and set max-width -->
    <!-- Search Bar -->
    <div class="input-group mb-3" style="padding: 32px;">
        <input type="text" class="form-control" placeholder="Search articles" id="searchInput">
        <button class="btn btn-light" type="button" id="searchButton"><?php echo $searchbutton; ?></button>
    </div>

    <?php
    $articlesDir = 'blog-posts';

    // Fetch articles from the directory
    $articleFiles = glob("$articlesDir/*.json");

    // Sort articles based on file modification time (most recent first)
    usort($articleFiles, function ($a, $b) {
        return filemtime($b) - filemtime($a);
    });

    foreach ($articleFiles as $file) {
        $content = file_get_contents($file);
        $article = json_decode($content, true);
        $articleId = pathinfo($file, PATHINFO_FILENAME); // Extract article ID from filename
        ?>
        <div class="article border p-3 text-left" style="margin: 32px;">       

            <div style="float:right;">
              <p class="text-muted badge bg-dark" style="color:white !important;"><?php echo $category; ?><?php echo $article['category']; ?></p>
              <p class="text-muted badge bg-dark" style="color:white !important;"><?php echo $createdat; ?><?php echo $article['created_at']; ?></p>
              <br />
            </div>

            <br />
            <?php if (!empty($article['image_url'])) : ?>
                <a href="<?php echo $article['image_url']; ?>" data-bs-toggle="modal" data-bs-target="#imageModal">
                  <img style="border-radius: 10px;width: 100%; height: auto; background-position: center; background-repeat: no-repeat; background-size: cover; position: relative;" src="<?php echo $article['image_url']; ?>" alt="Article Image" class="img-fluid mb-3">
                </a>
            <?php endif; ?>

            <h2 style="">
                <?php echo $article['title']; ?>
                <!--<a class="" style="text-align:center;" href="article.php?id=<?php //echo $articleId; ?>"><?php //echo $article['title']; ?></a>-->
            </h2>

            <!-- Display only the first 150 characters of the content -->
            <p style="background:black;color:white;padding: 13px;border-radius: 10px;"><?php echo substr($article['content'], 0, 150); ?>...
              <div style="float:right;">
              <?php
                $qrurl = 'https://chart.googleapis.com/chart?cht=qr&chl=';    
                $are7 = '80x80';
                echo '<img src="'.$qrurl.$websiteUrl.'article.php?id='.$articleId.'&chs='.$are7.'&choe=UTF-8&chld=L|2" alt="">';
              ?> 
              </div>
            </p>
            <br />
            <a class="article-btn btn" style="float: right;" href="article.php?id=<?php echo $articleId; ?>"><?php echo $readmore; ?></a>
            


            <!-- Social Buttons -->
            <a class="btn btn-secondary" href="#" onclick="copyToClipboard('<?php echo $websiteUrl; ?>article.php?id=<?php echo $articleId; ?>')" style="text-decoration: none;box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0), 0 1px 2px rgba(0, 0, 0, 0);border: 1px solid rgba(204, 204, 204, 0);border-bottom-color: rgba(179, 179, 179, 0);background-color: rgba(245, 245, 245, 0);background-image: linear-gradient(to bottom,rgba(255, 255, 255, 0),rgba(230, 230, 230, 0));">
                <i class="fa-regular fa-clipboard" style="color:black;font-size:30px;"></i>
            </a>
            <a class="btn btn-secondary" style="text-decoration: none;box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0), 0 1px 2px rgba(0, 0, 0, 0);border: 1px solid rgba(204, 204, 204, 0);border-bottom-color: rgba(179, 179, 179, 0);background-color: rgba(245, 245, 245, 0);background-image: linear-gradient(to bottom,rgba(255, 255, 255, 0),rgba(230, 230, 230, 0));" href="https://www.facebook.com/sharer/sharer.php?app_id=113869198637480&sdk=joey&title=<?php echo $article['title']; ?>&u=<?php echo $websiteUrl; ?>article.php?id=<?php echo $articleId; ?>" target="_blank">
                <i class="fa-brands fa-square-facebook" style="color:black;font-size:30px;"></i>
            </a>
            <a class="btn btn-secondary" style="text-decoration: none;box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0), 0 1px 2px rgba(0, 0, 0, 0);border: 1px solid rgba(204, 204, 204, 0);border-bottom-color: rgba(179, 179, 179, 0);background-color: rgba(245, 245, 245, 0);background-image: linear-gradient(to bottom,rgba(255, 255, 255, 0),rgba(230, 230, 230, 0));" href="https://trello.com/add-card?mode=popup&url=<?php echo $websiteUrl; ?>article.php?id=<?php echo $articleId; ?>&name=<?php echo $article['title']; ?>&desc=<?php echo $websiteUrl; ?>article.php?id=<?php echo $articleId; ?>" target="_blank">
                <i class="fa-brands fa-trello" style="color:black;font-size:30px;"></i>
            </a>


            <script>
                function copyToClipboard(text) {
                    const input = document.createElement('textarea');
                    input.value = text;
                    document.body.appendChild(input);
                    input.select();
                    document.execCommand('copy');
                    document.body.removeChild(input);
                    alert('Link copied to clipboard: ' + text);
                }
            </script>
            <!-- Social Buttons-->
        </div>
        <?php
    }
    ?>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function () {
        // Handle search button click
        $("#searchButton").on("click", function () {
            var searchTerm = $("#searchInput").val().toLowerCase();

            // Loop through articles and hide/show based on the search term
            $(".article").each(function () {
                var articleText = $(this).text().toLowerCase();
                if (articleText.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>

<!-- Bootstrap Modal for Image Zooming -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img style="width: 100%; height: auto; background-position: center; background-repeat: no-repeat; background-size: cover; position: relative;" src="" id="zoomedImage" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script>
    // Handle modal image zooming
    $('#imageModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var imageUrl = button.attr('href');
        var modal = $(this);
        modal.find('.modal-body #zoomedImage').attr('src', imageUrl);
    });
</script>

<?php require_once 'layout/footer.php'; ?>

<footer>

</footer>

  <!--| TEST CONTENT ABOVE THIS LINE |-->
  <!--

  ███████ ███    ██ ██████  
  ██      ████   ██ ██   ██ 
  █████   ██ ██  ██ ██   ██ 
  ██      ██  ██ ██ ██   ██ 
  ███████ ██   ████ ██████  
                                           
  -->
  <!--/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\-->


<!--|[000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000]|-->
<!--|[000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000]|-->
<!--|[000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000]|-->


    <span style="font-size:50px !important;cursor:pointer !important;position:fixed !important;bottom:25px !important;right:20px !important; padding:4px !important;border-radius:10px !important;" onclick="openNav()"><i class="fa fa-universal-access" aria-hidden="true" style="color: #2196f3;background: white;border-radius: 100px;"></i></span>

    <div id="mySidenav" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
    <div >
    <!--<span style="font-weight:bold;color:#ff9800;float:right !important;font-size: 25px;">Enjoy ADA compliant Features</span>-->
    <br/><br/>
    <button onclick="myFunction()"><i class="fa fa-star-half-o" aria-hidden="true" style="font-size: 20px !important;margin-left: 23px;"></i></button>
    <!--<span style="font-size: 10px;color: #fff;margin-left: 16px;padding-top: 4px;">Dark Mode</span>-->
    <label class="switch">
      <input type="checkbox" onclick="myFunction()">
      <span class="slider round"></span>
    </label>
    <br/><hr/>
    <button onclick="myFunction3()"><i class="fa fa-text-height" aria-hidden="true" style="font-size: 20px !important;margin-left: 23px;"></i></button>
    <label class="switch">
      <input type="checkbox" onclick="myFunction3()">
      <span class="slider round"></span>
    </label>
    <br/><hr/>
    <button onclick="myFunction2()"><i class="fa fa-eye" aria-hidden="true" style="font-size: 20px !important;margin-left: 23px;"></i></button>
    <label class="switch">
      <input type="checkbox" onclick="myFunction2()">
      <span class="slider round"></span>
    </label>    
    <br/><hr/>
    <button onclick="myFunction8()"><i class="fa fa-window-maximize" aria-hidden="true" style="font-size: 20px !important;margin-left: 23px;"></i></button>
    <label class="switch">
      <input type="checkbox" onclick="myFunction8()">
      <span class="slider round"></span>
    </label>
    <br/><hr/>
    <button onclick="myFunction88()"><i class="fa fa-file-image-o" aria-hidden="true" style="font-size: 20px !important;margin-left: 23px;"></i></button>
    <label class="switch">
      <input type="checkbox" onclick="myFunction88()">
      <span class="slider round"></span>
    </label>
    <br/><hr/>
    <button onclick="myFunction889()"><i class="fa fa-link" aria-hidden="true" style="font-size: 20px !important;margin-left: 23px;"></i></button>
    <label class="switch">
      <input type="checkbox" onclick="myFunction889()">
      <span class="slider round"></span>
    </label>
    <br/><hr/>
   
    <button onclick="openNav1()" style="font-size:15px;background-color: white;color: black;border-radius: 10px;margin-left: 5px;"><i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 20px !important;"></i> MORE</button>

    <br/>
    <br/>
    </div>
    <!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
    </div>


<!--|[000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000]|-->
<!--|[000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000]|-->
<!--|[000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000]|-->



<!--|[000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000]|-->
<!--|[000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000]|-->
<!--|[000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000]|-->

    <!---->
    <div id="mySidenav1" class="sidenav1">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav1()">&times;</a>
      <div style="padding-left:10px;">
        <!--<span style="font-weight:bold;color:#ff9800;float:right !important;font-size: 25px;">Enjoy ADA compliant Features</span>-->
        <br/><br/>
        <button onclick="myFunctionVideo()" style="margin-left: 13px;background-color: rgba(255, 255, 255, 0);margin-bottom:10px;border: none;color: black;"><i class="fa fa-file-video-o" aria-hidden="true" style="color:white;font-size: 20px !important;font-size: 20px !important;background: black;padding: 8px;border-radius: 40px;"></i> <br/>Remove<br/>Videos</button>
        <br/>
        <label class="switch">
          <input type="checkbox" onclick="myFunctionVideo()">
          <span class="slider round" style="border: 2px black solid;"></span>
        </label>
        <br/><br/>
        <button onclick="myFunctionColorBlind()" style="margin-left: 15px;background-color: rgba(255, 255, 255, 0);margin-bottom:10px;border: none;color: black;"><i class="fa fa-eye" aria-hidden="true" style="color:white;font-size: 20px !important;font-size: 20px !important;background: black;padding: 8px;border-radius: 40px;"></i> <br/>Color<br/>Blind</button>
        <br/>
        <label class="switch">
          <input type="checkbox" onclick="myFunctionColorBlind()">
          <span class="slider round" style="border: 2px black solid;"></span>
        </label>
        <br/><br/>
        <button onclick="myFunctionLargeImage()" style="margin-left: 15px;background-color: rgba(255, 255, 255, 0);margin-bottom:10px;border: none;color: black;"><i class="fa fa-picture-o" aria-hidden="true" style="color:white;font-size: 20px !important;font-size: 20px !important;background: black;padding: 8px;border-radius: 40px;"></i> <br/>Large<br/>Images</button>
        <br/>
        <label class="switch">
          <input type="checkbox" onclick="myFunctionLargeImage()">
          <span class="slider round" style="border: 2px black solid;"></span>
        </label>
        <!--<button onclick="myFunction3()"><i class="fa fa-text-height" aria-hidden="true" style="font-size: 50px !important;"></i></button>
        <br/><br/>
        <button onclick="myFunction2()"><i class="fa fa-eye" aria-hidden="true" style="font-size: 50px !important;"></i></button>  
        <br/><br/>
        <button onclick="myFunction8()"><i class="fa fa-window-maximize" aria-hidden="true" style="font-size: 50px !important;"></i></button>
        <br/><br/>
        <button onclick="myFunction88()"><i class="fa fa-file-image-o" aria-hidden="true" style="font-size: 50px !important;"></i></button>
        <br/><br/>
        <button onclick="myFunction889()"><i class="fa fa-link" aria-hidden="true" style="font-size: 50px !important;"></i></button>
        <br/>-->
        <br/><br/><br/>
        <button onclick="openNav2()" style="font-size:15px;background-color: black;color: white;border-radius: 10px;margin-left: 5px;"><i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 20px !important;"></i> MORE</button>
      </div>
    <!---->

<!--|[000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000]|-->
<!--|[000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000]|-->
<!--|[000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000]|-->


<!--|[000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000]|-->
<!--|[000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000]|-->
<!--|[000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000]|-->
    <!---->
    <div id="mySidenav2" class="sidenav2">
      <a href="javascript:void(0)" class="closebtn2" onclick="closeNav2()">&times;</a>
      <div style="padding-left:10px;">
        <!--<span style="font-weight:bold;color:#ff9800;float:right !important;font-size: 25px;">Enjoy ADA compliant Features</span>-->
        <br/><br/>
        <button onclick="myFunctionCenterText()" style="margin-left: 15px;background-color: rgba(255, 255, 255, 0);margin-bottom:10px;border: none;color: black;"><i class="fa fa-align-center" aria-hidden="true" style="color:white;font-size: 20px !important;font-size: 20px !important;background: black;padding: 8px;border-radius: 40px;"></i> <br/>Center<br/>Text</button>
        <br/>
        <label class="switch">
          <input type="checkbox" onclick="myFunctionCenterText()">
          <span class="slider round" style="border: 2px black solid;"></span>
        </label>
        <br/><br/>
        <button onclick="myFunctionTextRight()" style="margin-left: 15px;background-color: rgba(255, 255, 255, 0);margin-bottom:10px;border: none;color: black;"><i class="fa fa-align-right" aria-hidden="true" style="color:white;font-size: 20px !important;font-size: 20px !important;background: black;padding: 8px;border-radius: 40px;"></i> <br/>Text<br/>Right</button>
        <br/>
        <label class="switch">
          <input type="checkbox" onclick="myFunctionTextRight()">
          <span class="slider round" style="border: 2px black solid;"></span>
        </label>
        <br/><br/>
        <button onclick="myFunctionTextLeft()" style="margin-left: 15px;background-color: rgba(255, 255, 255, 0);margin-bottom:10px;border: none;color: black;"><i class="fa fa-align-left" aria-hidden="true" style="color:white;font-size: 20px !important;font-size: 20px !important;background: black;padding: 8px;border-radius: 40px;"></i> <br/>Text<br/>Left</button>
        <br/>
        <label class="switch">
          <input type="checkbox" onclick="myFunctionTextLeft()">
          <span class="slider round" style="border: 2px black solid;"></span>
        </label>
        <br/><br/>
        <button onclick="myFunctionBookMode()" style="margin-left: 15px;background-color: rgba(255, 255, 255, 0);margin-bottom:10px;border: none;color: black;"><i class="fa fa-book" aria-hidden="true" style="color:white;font-size: 20px !important;font-size: 20px !important;background: black;padding: 8px;border-radius: 40px;"></i> <br/>Book<br/>Mode</button>
        <br/>
        <label class="switch">
          <input type="checkbox" onclick="myFunctionBookMode()">
          <span class="slider round" style="border: 2px black solid;"></span>
        </label>

        <br/>
        <br/>
        <div id="google_translate_element"></div>
     
        
        <span style="font-size:13px;">Text to Speech (English)</span>
        <div class=buttons style="position: relative; bottom: 0; right: -39px;">
          <button id=play></button> &nbsp;
          <button id=pause></button> &nbsp;
          <button id=stop></button>
        </div>
        <br/>
        <!--<button onclick="myFunction3()"><i class="fa fa-text-height" aria-hidden="true" style="font-size: 50px !important;"></i></button>
        <br/><br/>
        <button onclick="myFunction2()"><i class="fa fa-eye" aria-hidden="true" style="font-size: 50px !important;"></i></button>  
        <br/><br/>
        <button onclick="myFunction8()"><i class="fa fa-window-maximize" aria-hidden="true" style="font-size: 50px !important;"></i></button>
        <br/><br/>
        <button onclick="myFunction88()"><i class="fa fa-file-image-o" aria-hidden="true" style="font-size: 50px !important;"></i></button>
        <br/><br/>
        <button onclick="myFunction889()"><i class="fa fa-link" aria-hidden="true" style="font-size: 50px !important;"></i></button>
        <br/>-->
      </div>
    <!---->
<!--|[000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000]|-->
<!--|[000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000]|-->
<!--|[000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000]|-->

<!--|###############################################################################################################################################|-->
<!--|###############################################################################################################################################|-->
<!--|###############################################################################################################################################|-->
<!--| Toggle Functions |-->
<script>
/////////////////////////////////////////////////////////////////////////////////////////////////////
        // Toggle Dark Mode
        /////////////////////////////////////////////////////////////////////////////////////////////////////
//        function myFunction() {
//        var element = document.body;
//        element.classList.toggle("dark-mode");
//        }
        //
            if (window.NodeList && !NodeList.prototype.forEach) {
                NodeList.prototype.forEach = function(callback, thisArg) {
                  thisArg = thisArg || window;
                  for (var i = 0; i < this.length; i++) {
                    callback.call(thisArg, this[i], i, this);
                  }
                };
              }

        function myFunction() {
            //const list = document.getElementsByTagName("body")[0];
            //list.classList.toggle("dark-mode");
            //const list1 = document.getElementsByTagName("h1")[0];
            //list1.classList.toggle("outline-title");



              document.querySelectorAll('body')
                  .forEach(function(p00) {
                    p00.classList.toggle('dark-mode');
                });
                document.querySelectorAll('div')
                  .forEach(function(p00) {
                    p00.classList.toggle('div-hide');
                });
                document.querySelectorAll('a')
                  .forEach(function(p003) {
                    p003.classList.toggle('a-hide');
                });
                document.querySelectorAll('button')
                  .forEach(function(p003) {
                    p003.classList.toggle('a-hide');
                });
                document.querySelectorAll('nav')
                  .forEach(function(p00) {
                    p00.classList.toggle('div-hide');
                });
 

        }
/////////////////////////////////////////////////////////////////////////////////////////////////////
        // Toggle Large Text
//        function myFunction3() {
//        var l = document.body;
//        l.classList.toggle("large-text");
//        }
/////////////////////////////////////////////////////////////////////////////////////////////////////
if (window.NodeList && !NodeList.prototype.forEach) {
                    NodeList.prototype.forEach = function(callback, thisArg) {
                      thisArg = thisArg || window;
                      for (var i = 0; i < this.length; i++) {
                        callback.call(thisArg, this[i], i, this);
                      }
                    };
                  }
      function myFunction3() {
          document.querySelectorAll('h2')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('large-text');
            });
            //
            document.querySelectorAll('h1')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('large-text');
            });
            //
            document.querySelectorAll('p')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('large-text');
            });
            //
            document.querySelectorAll('a')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('large-text');
            });
            //
            document.querySelectorAll('h3')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('large-text');
            });
            //
            document.querySelectorAll('h4')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('large-text');
            });
            //
            document.querySelectorAll('h5')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('large-text');
            });
            //
            document.querySelectorAll('h6')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('large-text');
            });
            //
        }
/////////////////////////////////////////////////////////////////////////////////////////////////////
        // Toggle Readable font Text
//        function myFunction2() {
//        var x = document.body;
//        x.classList.toggle("read-font-text");
//        }
        //
        function myFunction2() {
            const list = document.getElementsByTagName("body")[0];
            list.classList.toggle("read-font-text");
            //const list1 = document.getElementsByTagName("h1")[0];
            //list1.classList.toggle("outline-title");
        }
/////////////////////////////////////////////////////////////////////////////////////////////////////
        // Toggle Titles
        function myFunction8() {
            document.querySelectorAll('h1')
              .forEach(function(p3) {
                p3.classList.toggle('outline-title');
            });
            //
            document.querySelectorAll('h2')
              .forEach(function(p3) {
                p3.classList.toggle('outline-title');
            });
            //
            document.querySelectorAll('h3')
              .forEach(function(p3) {
                p3.classList.toggle('outline-title');
            });
            //
            document.querySelectorAll('h4')
              .forEach(function(p3) {
                p3.classList.toggle('outline-title');
            });
            //
            document.querySelectorAll('h5')
              .forEach(function(p3) {
                p3.classList.toggle('outline-title');
            });
            //
            document.querySelectorAll('h6')
              .forEach(function(p3) {
                p3.classList.toggle('outline-title');
            });
        }
/////////////////////////////////////////////////////////////////////////////////////////////////////
if (window.NodeList && !NodeList.prototype.forEach) {
                    NodeList.prototype.forEach = function(callback, thisArg) {
                      thisArg = thisArg || window;
                      for (var i = 0; i < this.length; i++) {
                        callback.call(thisArg, this[i], i, this);
                      }
                    };
                  }
        // Toggle Hide Images
        function myFunction88() {
            document.querySelectorAll('img')
              .forEach(function(p3) {
                p3.classList.toggle('img-hide');
            });
            //const list = document.getElementsByTagName("img")[0];
            //list.classList.toggle("img-hide");
        }
/////////////////////////////////////////////////////////////////////////////////////////////////////
        // Toggle Hide Videos
//        function myFunctionVideo() {
//          var pElems = document.getElementsByTagName("video");
//          for ( var i = 0; i < pElems.length; i++) {
//            pElems.classList.toggle("video-hide");
//          }
//        }
        if (window.NodeList && !NodeList.prototype.forEach) {
            NodeList.prototype.forEach = function(callback, thisArg) {
              thisArg = thisArg || window;
              for (var i = 0; i < this.length; i++) {
                callback.call(thisArg, this[i], i, this);
              }
            };
          }

        function myFunctionVideo() {
          document.querySelectorAll('video')
              .forEach(function(p) {
                p.classList.toggle('video-hide');
            });
        }
 
//
/////////////////////////////////////////////////////////////////////////////////////////////////////      
        // Toggle Outline Links
        if (window.NodeList && !NodeList.prototype.forEach) {
            NodeList.prototype.forEach = function(callback, thisArg) {
              thisArg = thisArg || window;
              for (var i = 0; i < this.length; i++) {
                callback.call(thisArg, this[i], i, this);
              }
            };
          }

        function myFunction889() {
          document.querySelectorAll('a')
              .forEach(function(p) {
                p.classList.toggle('outline-links');
            });
        }


        
 //       function myFunction889() {
 //           const list2 = document.getElementsByTagName("a")[0]; 
 //           list2.classList.toggle("outline-links");
 //       }



/////////////////////////////////////////////////////////////////////////////////////////////////////
        if (window.NodeList && !NodeList.prototype.forEach) {
                    NodeList.prototype.forEach = function(callback, thisArg) {
                      thisArg = thisArg || window;
                      for (var i = 0; i < this.length; i++) {
                        callback.call(thisArg, this[i], i, this);
                      }
                    };
                  }
        // Toggle ColorBlind
        function myFunctionColorBlind() {
            //
            document.querySelectorAll('button')
                  .forEach(function(p003) {
                    p003.classList.toggle('a-hide2');
                });
            //
            document.querySelectorAll('h2')
              .forEach(function(pl) {
                pl.classList.toggle('colorblind-text');
            });
            //
            document.querySelectorAll('a')
              .forEach(function(pls) {
                pls.classList.toggle('colorblind-text');
            });
            document.querySelectorAll('h1')
              .forEach(function(pl) {
                pl.classList.toggle('colorblind-text');
            });
            //
            document.querySelectorAll('h3')
              .forEach(function(pls) {
                pls.classList.toggle('colorblind-text');
            });
            document.querySelectorAll('h4')
              .forEach(function(pl) {
                pl.classList.toggle('colorblind-text');
            });
            //
            document.querySelectorAll('h5')
              .forEach(function(pls) {
                pls.classList.toggle('colorblind-text');
            });
            //
            document.querySelectorAll('h6')
              .forEach(function(pls) {
                pls.classList.toggle('colorblind-text');
            });
            //
            document.querySelectorAll('p')
              .forEach(function(pls) {
                pls.classList.toggle('colorblind-text');
            });
            document.querySelectorAll('div')
                  .forEach(function(p00) {
                    p00.classList.toggle('div-hide2');
                });            
        }


/////////////////////////////////////////////////////////////////////////////////////////////////////
        if (window.NodeList && !NodeList.prototype.forEach) {
                    NodeList.prototype.forEach = function(callback, thisArg) {
                      thisArg = thisArg || window;
                      for (var i = 0; i < this.length; i++) {
                        callback.call(thisArg, this[i], i, this);
                      }
                    };
                  }
        // Toggle Large Images
        function myFunctionLargeImage() {
            //
            document.querySelectorAll('img')
              .forEach(function(plss) {
                plss.classList.toggle('large-image');
            });
            //
        }
//////////////////////////////////////////////4///////////////////////////////////////////////////////
if (window.NodeList && !NodeList.prototype.forEach) {
                    NodeList.prototype.forEach = function(callback, thisArg) {
                      thisArg = thisArg || window;
                      for (var i = 0; i < this.length; i++) {
                        callback.call(thisArg, this[i], i, this);
                      }
                    };
                  }
        // Toggle CenterText
        function myFunctionCenterText() {
            //
            document.querySelectorAll('p')
              .forEach(function(plsss) {
                plsss.classList.toggle('center-text');
            });
            //
            document.querySelectorAll('h1')
              .forEach(function(plsssd) {
                plsssd.classList.toggle('center-text');
            });
            //
            document.querySelectorAll('h2')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('center-text');
            });
            //
            //
            document.querySelectorAll('h3')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('center-text');
            });
            //
            document.querySelectorAll('h4')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('center-text');
            });
            //
            document.querySelectorAll('h5')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('center-text');
            });
            //
            document.querySelectorAll('h6')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('center-text');
            });
            //
        }
/////////////////////////////////////////////////////////////////////////////////////////////////////
if (window.NodeList && !NodeList.prototype.forEach) {
                    NodeList.prototype.forEach = function(callback, thisArg) {
                      thisArg = thisArg || window;
                      for (var i = 0; i < this.length; i++) {
                        callback.call(thisArg, this[i], i, this);
                      }
                    };
                  }
        // Toggle RightText
        function myFunctionTextRight() {
            //
            document.querySelectorAll('p')
              .forEach(function(plsss) {
                plsss.classList.toggle('right-text');
            });
            //
            document.querySelectorAll('h1')
              .forEach(function(plsssd) {
                plsssd.classList.toggle('right-text');
            });
            //
            document.querySelectorAll('h2')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('right-text');
            });
            //
            //
            document.querySelectorAll('h3')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('right-text');
            });
            //
            document.querySelectorAll('h4')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('right-text');
            });
            //
            document.querySelectorAll('h5')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('right-text');
            });
            //
            document.querySelectorAll('h6')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('right-text');
            });
            //
        }
/////////////////////////////////////////////////////////////////////////////////////////////////////
if (window.NodeList && !NodeList.prototype.forEach) {
                    NodeList.prototype.forEach = function(callback, thisArg) {
                      thisArg = thisArg || window;
                      for (var i = 0; i < this.length; i++) {
                        callback.call(thisArg, this[i], i, this);
                      }
                    };
                  }
        // Toggle CenterText
        function myFunctionTextLeft() {
            //
            document.querySelectorAll('p')
              .forEach(function(plsss) {
                plsss.classList.toggle('left-text');
            });
            //
            document.querySelectorAll('h1')
              .forEach(function(plsssd) {
                plsssd.classList.toggle('left-text');
            });
            //
            document.querySelectorAll('h2')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('left-text');
            });
            //
            //
            document.querySelectorAll('h3')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('left-text');
            });
            //
            document.querySelectorAll('h4')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('left-text');
            });
            //
            document.querySelectorAll('h5')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('left-text');
            });
            //
            document.querySelectorAll('h6')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('left-text');
            });
            //
        }
/////////////////////////////////////////////////////////////////////////////////////////////////////
if (window.NodeList && !NodeList.prototype.forEach) {
                    NodeList.prototype.forEach = function(callback, thisArg) {
                      thisArg = thisArg || window;
                      for (var i = 0; i < this.length; i++) {
                        callback.call(thisArg, this[i], i, this);
                      }
                    };
                  }
        // Toggle Book Mode
        function myFunctionBookMode() {
            //
             document.querySelectorAll('button')
                  .forEach(function(p003) {
                    p003.classList.toggle('a-hide2');
                });
            //
            document.querySelectorAll('p')
              .forEach(function(plsss) {
                plsss.classList.toggle('center-text');
            });
            //
            document.querySelectorAll('h1')
              .forEach(function(plsssd) {
                plsssd.classList.toggle('center-text');
            });
            //
            document.querySelectorAll('h2')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('center-text');
            });
            //
            document.querySelectorAll('h3')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('center-text');
            });
            //
            document.querySelectorAll('h4')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('center-text');
            });
            //
            document.querySelectorAll('h5')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('center-text');
            });
            //
            document.querySelectorAll('h6')
              .forEach(function(plsssdd) {
                plsssdd.classList.toggle('center-text');
            });
            //
            document.querySelectorAll('video')
              .forEach(function(p4) {
                p4.classList.toggle('video-hide');
            });
            document.querySelectorAll('img')
              .forEach(function(p3) {
                p3.classList.toggle('img-hide');
            });
            const list = document.getElementsByTagName("body")[0];
            list.classList.toggle("book-mode")
            //
            document.querySelectorAll('div')
                  .forEach(function(p00) {
                    p00.classList.toggle('div-hide-book');
                });
            document.querySelectorAll('span')
                  .forEach(function(p00) {
                    p00.classList.toggle('dark-span');
                });
        }
/////////////////////////////////////////////////////////////////////////////////////////////////////
    </script>
<!--| Toggle Functions |-->
<!--|###############################################################################################################################################|-->
<!--|###############################################################################################################################################|-->
<!--|###############################################################################################################################################|-->
<!--|-----------------------------------------------------------------------------------------------------------------------------------------------|-->
<!--|###############################################################################################################################################|-->
<!--|###############################################################################################################################################|-->
<!--|###############################################################################################################################################|-->
<!--| Side Nav Open and Close Button .JS |-->
    <script>
      function openNav() {
        document.getElementById("mySidenav").style.width = "90px";
      }
      
      function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
      }
    </script>

    <script>
      function openNav1() {
        document.getElementById("mySidenav1").style.width = "190px";
      }
      
      function closeNav1() {
        document.getElementById("mySidenav1").style.width = "0";
      }
    </script>

    <script>
      function openNav2() {
        document.getElementById("mySidenav2").style.width = "290px";
      }
      
      function closeNav2() {
        document.getElementById("mySidenav2").style.width = "0";
      }
    </script>
    <!--| Side Nav Open and Close Button .JS |-->
    <!--|###############################################################################################################################################|-->
    <!--|###############################################################################################################################################|-->
    <!--|###############################################################################################################################################|-->
    
    <!--| GOOGLE TRANSLATE |-->
    <script type="text/javascript">
      function googleTranslateElementInit() {
          new google.translate.TranslateElement(
              {pageLanguage: 'en'},
              'google_translate_element'
          );
      }
    </script>
   <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
   <!--| GOOGLE TRANSLATE |-->


    <!--| TEXT-2-SPEECH |-->
    <script>
    onload = function() {
      if ('speechSynthesis' in window) with(speechSynthesis) {

        var playEle = document.querySelector('#play');
        var pauseEle = document.querySelector('#pause');
        var stopEle = document.querySelector('#stop');
        var flag = false;

        playEle.addEventListener('click', onClickPlay);
        pauseEle.addEventListener('click', onClickPause);
        stopEle.addEventListener('click', onClickStop);

        function onClickPlay() {
          if (!flag) {
            flag = true;
            utterance = new SpeechSynthesisUtterance(document.querySelector('article').textContent);
            utterance.voice = getVoices()[0];
            utterance.onend = function() {
              flag = false;
              playEle.className = pauseEle.className = '';
              stopEle.className = 'stopped';
            };
            playEle.className = 'played';
            stopEle.className = '';
            speak(utterance);
          }
          if (paused) { /* unpause/resume narration */
            playEle.className = 'played';
            pauseEle.className = '';
            resume();
          }
        }

        function onClickPause() {
          if (speaking && !paused) { /* pause narration */
            pauseEle.className = 'paused';
            playEle.className = '';
            pause();
          }
        }

        function onClickStop() {
          if (speaking) { /* stop narration */
            /* for safari */
            stopEle.className = 'stopped';
            playEle.className = pauseEle.className = '';
            flag = false;
            cancel();

          }
        }

      }

      else { /* speech synthesis not supported */
        msg = document.createElement('h5');
        msg.textContent = "Detected no support for Speech Synthesis";
        msg.style.textAlign = 'center';
        msg.style.backgroundColor = 'red';
        msg.style.color = 'white';
        msg.style.marginTop = msg.style.marginBottom = 0;
        document.body.insertBefore(msg, document.querySelector('div'));
      }

    }
    </script>
    <!--| TEXT-2-SPEECH |-->

    <!--
      | CDNS |
    -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!--
      | CDNS |
    -->
    <!--| ================================== |-->
    <!--| ================================== |-->
    <!--| ===============END================ |-->
    <!--| ================================== |-->
    <!--| ================================== |-->
    <script src="js/custom.js"></script>

  </body>
</html>