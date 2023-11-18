<?php
$uploadFolder = 'uploads/';

$html = '';

$files = glob($uploadFolder . '*');
if ($files) {
    foreach ($files as $file) {
        if (is_file($file)) {
            $filename = basename($file);
            $fileUrl = 'http://yourdomain.com/' . $uploadFolder . $filename; // Change this URL to match your domain and folder structure

            $html .= '<li>' . $filename . 
                     ' <button onclick="deleteFile(\'' . $filename . '\')">Delete</button>' .
                     ' <button onclick="renameFile(\'' . $filename . '\', prompt(\'Enter new name:\', \'' . $filename . '\'))">Rename</button>' .
                     ' <button onclick="copyFileUrl(\'' . $fileUrl . '\')">Copy URL</button>' .
                     '</li>';
        }
    }
}

echo $html;
?>