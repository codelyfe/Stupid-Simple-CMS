<?php
/*
┏┓┏┓┳┓┏┓┓ ┓┏┏┓┏┓
┃ ┃┃┃┃┣ ┃ ┗┫┣ ┣ 
┗┛┗┛┻┛┗┛┗┛┗┛┻ ┗┛
*/              
?>
<?php
require_once __DIR__ . '/includes/store.php';
$site = site_settings();
$siteTitle = $site['title'];
$siteCopyright = $site['copyright'];
$websiteUrl = $site['websiteurl'];
$metatxtdesc = $site['metatxtdesc'];
$metaimg = $site['metaimg'];
$currentYear = date('Y');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    $cmsBase = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/') . '/';
    echo '<base href="' . htmlspecialchars($cmsBase, ENT_QUOTES) . '">';
    ?>

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
        dataType: 'json',
        data: { element: 'all' },
        success: function(theme) {
          if (!theme) return;
          if (theme.background_image) {
            $('body').css('background-image', 'url(' + theme.background_image + ')');
          }
          if (theme.background) $('body').css('background-color', theme.background);
          if (theme.fontcolor) $('body').css('color', theme.fontcolor);
          if (theme.article_background) $('.article').css('background-color', theme.article_background);
          if (theme.article_btn_background) $('.article-btn').css('background-color', theme.article_btn_background);
          if (theme.article_btnfc_background) $('.article-btn').css('color', theme.article_btnfc_background);
          var root = document.documentElement;
          if (theme.accent) root.style.setProperty('--accent', theme.accent);
          if (theme.nav_color) root.style.setProperty('--nav', theme.nav_color);
          if (theme.heading_color) root.style.setProperty('--heading', theme.heading_color);
          if (theme.card_radius) root.style.setProperty('--radius', theme.card_radius + 'px');
          if (theme.overlay !== '') root.style.setProperty('--veil', (Number(theme.overlay) / 100).toString());
          var faces = { fraunces: '"Fraunces", Georgia, serif', newsreader: '"Newsreader", Georgia, serif', libre: '"Libre Baskerville", Georgia, serif' };
          if (theme.typeface && faces[theme.typeface]) root.style.setProperty('--serif', faces[theme.typeface]);
          if (theme.content_width) root.style.setProperty('--measure', theme.content_width + 'px');
          if (theme.image_height) root.style.setProperty('--photo', theme.image_height + 'px');
          if (theme.heading_color) $('.blog-title').css('color', theme.heading_color);
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

<div class="page-wrap">
    <form class="search-bar" onsubmit="return false;">
        <input type="text" class="form-control" placeholder="Search articles" id="searchInput">
        <button type="button" id="searchButton"><?php echo $searchbutton; ?></button>
    </form>

    <?php
    foreach (articles_all() as $article) {
        $articleId = $article['id'];
        ?>
        <article class="article text-left">
            <div class="article-meta">
              <span class="badge blog-cat"><?php echo $category; ?><?php echo htmlspecialchars((string) $article['category']); ?></span>
              <span class="badge blog-created"><?php echo $createdat; ?><?php echo htmlspecialchars((string) $article['created_at']); ?></span>
            </div>

            <?php if (!empty($article['image_url'])) : ?>
                <a href="<?php echo htmlspecialchars($article['image_url']); ?>" data-bs-toggle="modal" data-bs-target="#imageModal">
                  <img src="<?php echo htmlspecialchars($article['image_url']); ?>" alt="" class="img-fluid" loading="lazy">
                </a>
            <?php endif; ?>

            <h2 class="blog-title"><?php echo htmlspecialchars((string) $article['title']); ?></h2>

            <p class="blog-content"><?php echo htmlspecialchars(substr(strip_tags((string) $article['content']), 0, 150)); ?>...</p>

            <div class="article-actions">
            <a class="share-btn blog-clipboard" href="#" onclick="copyToClipboard('<?php echo $websiteUrl; ?>article.php?id=<?php echo $articleId; ?>'); return false;">
                <i class="fa-regular fa-clipboard"></i>
            </a>
            <a class="share-btn blog-fb" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $websiteUrl; ?>article.php?id=<?php echo $articleId; ?>" target="_blank" rel="noopener">
                <i class="fa-brands fa-facebook"></i>
            </a>
            <a class="share-btn blog-trello" href="https://trello.com/add-card?mode=popup&url=<?php echo $websiteUrl; ?>article.php?id=<?php echo $articleId; ?>&name=<?php echo urlencode((string) $article['title']); ?>" target="_blank" rel="noopener">
                <i class="fa-brands fa-trello"></i>
            </a>
            <a class="article-btn btn" href="article.php?id=<?php echo $articleId; ?>"><?php echo $readmore; ?></a>
            </div>


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
        </article>
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