<?php
// Assuming $selectlang is the variable holding the language
include "settings/global.php"; // Make sure $selectlang is defined in this file

// Concatenate the variable with the string in the include statement
include "text-content/{$selectlang}.php";
?>
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="../">
            <?php echo $sitetitle; ?>
        </a>
        <a class="navbar-link btn btn-warning" href="add-article.php">
            <?php echo $submitanarticle; ?>
        </a>


        <!-- Add your other navigation items here -->

    </div>
</nav>