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
$websiteUrl = (string)$xml->websiteurl;
$greetingTxt = (string)$xml->greetingtxt;
$currentYear = date('Y');
} 
else {
 echo 'Failed to load XML file.';
}
?>
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="<?php echo htmlspecialchars($websiteUrl); ?>"><?php echo htmlspecialchars($siteTitle); ?></a>
        <a class="nav-write" href="add-article.php"><i class="fa-solid fa-feather"></i> <?php echo $submitanarticle; ?></a>
    </div>
</nav>