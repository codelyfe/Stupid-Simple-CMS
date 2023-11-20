<?php
// Assuming $selectlang is the variable holding the language
include "settings/global.php"; // Make sure $selectlang is defined in this file

// Concatenate the variable with the string in the include statement
include "text-content/{$selectlang}.php";
?>
<?php
// Path to your XML file
$xmlFile = 'admin/site-settings.xml';

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
        <a class="navbar-brand" href="../index.php">
            <?php echo $siteTitle; ?> (Admin)
        </a>
        <a class="navbar-link btn btn-danger" href="logout.php">
            <?php echo $logoutbutton; ?>
        </a>

    </div>
</nav>