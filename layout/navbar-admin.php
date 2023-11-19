<?php
// Assuming $selectlang is the variable holding the language
include "settings/global.php"; // Make sure $selectlang is defined in this file

// Concatenate the variable with the string in the include statement
include "text-content/{$selectlang}.php";
?>
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="../index.php">
            <?php echo $admintitle; ?>
        </a>
        <a class="navbar-link btn btn-danger" href="logout.php">
            <?php echo $logoutbutton; ?>
        </a>

    </div>
</nav>