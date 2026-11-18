<?php
// Assuming $selectlang is the variable holding the language
include "settings/global.php"; // Make sure $selectlang is defined in this file

// Concatenate the variable with the string in the include statement
include "text-content/{$selectlang}.php";
?>
<?php
require_once __DIR__ . '/../includes/store.php';
$site = site_settings();
$siteTitle = $site['title'];
$siteCopyright = $site['copyright'];
$websiteUrl = $site['websiteurl'];
$greetingTxt = $site['greetingtxt'];
$currentYear = date('Y');
?>
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="<?php echo htmlspecialchars($websiteUrl); ?>"><?php echo htmlspecialchars($siteTitle); ?></a>
        <a class="nav-write" href="add-article.php"><i class="fa-solid fa-feather"></i> <?php echo $submitanarticle; ?></a>
    </div>
</nav>