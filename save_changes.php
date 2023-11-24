    <?php
    /*
    ┏┓┏┓┳┓┏┓┓ ┓┏┏┓┏┓
    ┃ ┃┃┃┃┣ ┃ ┗┫┣ ┣ 
    ┗┛┗┛┻┛┗┛┗┛┗┛┻ ┗┛
    */              
    ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $xmlFile = 'theme.xml'; // Replace with your XML file name/location
        $xml = simplexml_load_file($xmlFile);
        //                      //
        // Change background color
        if (isset($_POST['background'])) {
            $xml->background = $_POST['background'];
        }
        //                      //
        // Change font color
        if (isset($_POST['fontcolor'])) {
            $xml->fontcolor = $_POST['fontcolor'];
        }
        //                      //
        // Article Background Color
        if (isset($_POST['article_background_color'])) {
            $xml->article_background_color = $_POST['article_background_color'];
        }
        //                      //
        // Article Button Background Color
        if (isset($_POST['article_btn_background_color'])) {
            $xml->article_btn_background_color = $_POST['article_btn_background_color'];
        }
        //                      //
        // Article Button Font Color
        if (isset($_POST['article_btn_font_color'])) {
            $xml->article_btn_font_color = $_POST['article_btn_font_color'];
        }
        //                      //
        // Change background image (URL)
        if (isset($_POST['background_image_url'])) {
            $imageUrl = $_POST['background_image_url'];
            //                      //
            // Validate the URL (optional)
            if (filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                // Update XML with the new image URL directly
                $xml->background_image = $imageUrl;
                $xml->asXML($xmlFile);
                //                      //
                echo 'Background image URL updated successfully!';
            } else {
                echo 'Invalid URL format!';
            }
        }
        //                      //
        // Save changes to XML file
        $xml->asXML($xmlFile);
    } else {
        echo 'Invalid request';
    }
    ?>