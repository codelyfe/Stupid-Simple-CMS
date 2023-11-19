<?php
$uploadFolder = 'uploads/';

$html = '';

$files = glob($uploadFolder . '*');
if ($files) {
    foreach ($files as $file) {
        if (is_file($file)) {
            $filename = basename($file);
            $fileUrl = 'https://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/' . $uploadFolder . $filename;

            // Check if the file is an image by checking its extension
            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
            $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            if (in_array($fileExtension, $imageExtensions)) {
                // If it's an image file, display thumbnail
                $html .= '<li>' . 
                         ' <img src="' . $fileUrl . '" alt="' . $filename . '" style="max-width: 100px; max-height: 100px;"> ' . $filename .
                         ' <div style="float: right;">' .
                         '     <button class="btn btn-danger" onclick="deleteFile(\'' . $filename . '\')"><i class="fa-solid fa-trash"></i></button>' .
                         '     <button class="btn btn-dark" onclick="copyFileUrl(\'' . $fileUrl . '\')"><i class="fa-regular fa-clipboard"></i></button>' .
                         '     <button class="btn btn-dark" onclick="renameFile(\'' . $filename . '\', prompt(\'Enter new name:\', \'' . $filename . '\'))">Rename</button>' .
                         ' </div>' .
                         '</li>';
            } else {
                // For non-image files, display the filename without thumbnail
                $html .= '<li>' . $filename . 
                         ' <div style="float: right;">' .
                         '     <button class="btn btn-danger" onclick="deleteFile(\'' . $filename . '\')"><i class="fa-solid fa-trash"></i></button>' .
                         '     <button class="btn btn-dark" onclick="copyFileUrl(\'' . $fileUrl . '\')"><i class="fa-regular fa-clipboard"></i></button>' .
                         '     <button class="btn btn-dark" onclick="renameFile(\'' . $filename . '\', prompt(\'Enter new name:\', \'' . $filename . '\'))">Rename</button>' .
                         ' </div>' .
                         '</li>';
            }
        }
    }
}

echo $html;
?>