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
                     ' <button class="btn btn-danger" onclick="deleteFile(\'' . $filename . '\')"><i class="fa-solid fa-trash"></i></button>' .
                     ' <button class="btn btn-dark" onclick="copyFileUrl(\'' . $fileUrl . '\')"><i class="fa-regular fa-clipboard"></i></button>' .
                     ' <button class="btn btn-dark" onclick="renameFile(\'' . $filename . '\', prompt(\'Enter new name:\', \'' . $filename . '\'))">Rename</button>' .
                     '</li>';
        }
    }
}

echo $html;
?>