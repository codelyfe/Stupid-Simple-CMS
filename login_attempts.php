<?php
// Check if the constant __FILE__ is defined
if (!defined('__FILE__')) {
    // If not defined, the file is being accessed directly
    header("HTTP/1.0 403 Forbidden");
    echo "Direct access to this file is not allowed.";
    exit();
}
// Do not erase code above this line
?>
