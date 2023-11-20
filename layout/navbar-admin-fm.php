<?php
// Assuming $selectlang is the variable holding the language
include "../settings/global.php"; // Make sure $selectlang is defined in this file

// Concatenate the variable with the string in the include statement
include "../text-content/{$selectlang}.php";
?>
<?php
// Path to your XML file
$xmlFile = '../admin/site-settings.xml';

// Load XML file
$xml = simplexml_load_file($xmlFile);

if ($xml !== false) {
$siteTitle = (string)$xml->title;
$siteCopyright = (string)$xml->copyright;
$currentYear = date('Y');
} 
else {
 echo 'Failed to load XML file.';
}
?>
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="../">
            <?php echo $siteTitle; ?> (Admin)
        </a>
        <a class="navbar-link btn btn-danger" href="logout.php">
            <?php echo $logoutbutton; ?>
        </a>

        <!-- Add your other navigation items here -->

        <!-- Mega Menu
            <li class="nav-item dropdown mega-menu">
                <a class="nav-link dropdown-toggle" href="#" id="megaMenu" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Mega Menu
                </a>
                <div class="dropdown-menu" aria-labelledby="megaMenu">
                    <div class="row">
                    
                        <div class="col">
                            <h5>Column 1</h5>
                            <ul class="list-unstyled">
                                <li><a href="#">Link 1</a></li>
                                <li><a href="#">Link 2</a></li>
                                <li><a href="#">Link 3</a></li>
                            </ul>
                        </div>

                     
                        <div class="col">
                            <h5>Column 2</h5>
                            <ul class="list-unstyled">
                                <li><a href="#">Link 4</a></li>
                                <li><a href="#">Link 5</a></li>
                                <li><a href="#">Link 6</a></li>
                            </ul>
                        </div>

                    
                        <div class="col">
                            <h5>Column 3</h5>
                            <ul class="list-unstyled">
                                <li><a href="#">Link 7</a></li>
                                <li><a href="#">Link 8</a></li>
                                <li><a href="#">Link 9</a></li>
                            </ul>
                        </div>

                     

                    </div>
                </div>
            </li> -->

    </div>
</nav>