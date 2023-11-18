<?php
$uploadFolder = 'uploads/';

$html = '';

$files = glob($uploadFolder . '*');
if ($files) {
    foreach ($files as $file) {
        if (is_file($file)) {
            $filename = basename($file);
            $html .= '<li>' . $filename . 
                     ' <button class="btn btn-primary" onclick="deleteFile(\'' . $filename . '\')">Delete</button>' .
                     ' <button class="btn btn-primary" onclick="renameFile(\'' . $filename . '\', prompt(\'Enter new name:\', \'' . $filename . '\'))">Rename</button>' .
                     '</li>';
        }
    }
}

echo $html;
?>