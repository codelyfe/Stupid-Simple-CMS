<?php
$uploadFolder = 'uploads/';

$html = '';

$files = glob($uploadFolder . '*');
if ($files) {
    foreach ($files as $file) {
        if (is_file($file)) {
            $filename = basename($file);
            $fileUrl = 'https://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/' . $uploadFolder . $filename;

            $html .= '<li styl="float:right;">' . $filename . 
                     ' <button class="btn btn-danger" onclick="deleteFile(\'' . $filename . '\')">Delete</button>' .
                     ' <button class="btn btn-success" onclick="renameFile(\'' . $filename . '\', prompt(\'Enter new name:\', \'' . $filename . '\'))">Rename</button>' .
                     ' <button class="btn btn-primary" onclick="copyFileUrl(\'' . $fileUrl . '\')">Copy URL</button>' .
                     '</li>';
        }
    }
}

echo $html;
?>