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
//
if ($xml !== false) {
$siteTitle = (string)$xml->title;
$siteCopyright = (string)$xml->copyright;
$websiteUrl = (string)$xml->websiteurl;
$currentYear = date('Y');
} 
else {
 echo 'Failed to load XML file.';
}
?>
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $websiteUrl; ?>">
            <?php echo $siteTitle; ?> (Admin)
        </a> 
        <li class="nav-item btn btn-light dropdown" style="list-style: none;">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa-solid fa-gear" style="color: black;"></i> MENU
          </a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo $websiteUrl; ?>admin/" class="dropdown-item"><i class="fa-solid fa-wrench" style="color: #000000;"></i> General Settings</a></li> 
            <li><a href="<?php echo $websiteUrl; ?>file-manager/" class="dropdown-item"><i class="fa-solid fa-folder-open" style="color: #000000;"></i> File Manager</a><l/i> 
            <li><a href="<?php echo $websiteUrl; ?>design-blog.php" class="dropdown-item"><i class="fa-solid fa-brush" style="color: #000000;"></i> Design Blog</a></li>            
            <li><a href="<?php echo $websiteUrl; ?>editor-js.php" class="dropdown-item"><i class="fa-brands fa-js" style="color: #000000;"></i> Custom JS</a></li> 
            <li><a href="<?php echo $websiteUrl; ?>editor-css.php" class="dropdown-item"><i class="fa-brands fa-css3" style="color: #000000;"></i> Custom CSS</a></li>             
            <li><a href="<?php echo $websiteUrl; ?>admin-edit.php" class="dropdown-item"><i class="fa-solid fa-pen-to-square" style="color: #000000;"></i> Edit Articles</a></li> 
            <li><a href="<?php echo $websiteUrl; ?>index.php" class="dropdown-item"><i class="fa-regular fa-rectangle-list" style="color: #000000;"></i> Blog</a></li>
            <li><a href="<?php echo $websiteUrl; ?>help/" class="dropdown-item"><i class="fa-solid fa-question" style="color: #000000;"></i> Help Desk</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a href="<?php echo $websiteUrl; ?>add-article.php" style="background: black;color: white;" class="dropdown-item"><i class="fa-solid fa-feather" style="color: #ffc107;"></i> Add Article</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
            <a class="dropdown-item btn btn-danger" href="logout.php">
                <?php echo $logoutbutton; ?>
            </a>
            </li>
          </ul>
        </li>
    </div>
</nav>