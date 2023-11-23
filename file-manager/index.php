<?php
    /*
    ┏┓┏┓┳┓┏┓┓ ┓┏┏┓┏┓
    ┃ ┃┃┃┃┣ ┃ ┗┫┣ ┣ 
    ┗┛┗┛┻┛┗┛┗┛┗┛┻ ┗┛
    */              
    ?>
<?php 
    session_start();

    if (!isset($_SESSION['UserData']['Username'])) {
        header("location:../login.php");
        exit;
    }
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>File Manager</title>
    <link rel="stylesheet" type="text/css" href="../css/custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php require_once '../layout/header-admin-fm.php'; ?>
    <style>
        .listIt{
            font-size: 26px;
            background: var(--bs-gray-800);
            color: white;
            padding: 20px;
            margin-bottom: 10px;
            border-radius: 10px;
            list-style: none;
        }
    </style>
</head>
<body>
<?php require_once '../layout/navbar-admin-fm.php'; ?>
<br /><br/>
<h1 class="mx-auto" style="text-align: center;color:white;"><i class="fa-solid fa-folder-open" style="color: #ffc107;"></i> File Manager <br />
<!--
<a href="<?php //echo $websiteUrl; ?>terminal/" class="btn btn-dark"><i class="fa-solid fa-code" style="color: #ffc107;"></i> Terminal</a> 
<a href="<?php //echo $websiteUrl; ?>add-article.php" class="btn btn-dark"><i class="fa-solid fa-feather" style="color: #ffc107;"></i> Add Article</a> 
<a href="<?php //echo $websiteUrl; ?>design-blog.php" class="btn btn-dark"><i class="fa-solid fa-brush" style="color: #ffc107;"></i> Design Blog</a> 
<a href="<?php //echo $websiteUrl; ?>editor-js.php" class="btn btn-dark"><i class="fa-brands fa-js" style="color: #ffc107;"></i> Custom JS</a> 
<a href="<?php //echo $websiteUrl; ?>editor-css.php" class="btn btn-dark"><i class="fa-brands fa-css3" style="color: #ffc107;"></i> Custom CSS</a> 
<a href="<?php //echo $websiteUrl; ?>admin-edit.php" class="btn btn-dark"><i class="fa-solid fa-pen-to-square" style="color: #ffc107;"></i> Edit Articles</a> 
<a href="<?php //echo $websiteUrl; ?>index.php" class="btn btn-dark"><i class="fa-regular fa-rectangle-list" style="color: #ffc107;"></i> Blog</a>
-->
</h1>

<br />

<div class="container" style="background-color:white;padding:50px;border-radius:10px;">
    <p>Copy URL for blog image link or background image for blog</p>
    <br />
    <input class="form-control" type="file" id="fileInput">
    <br/>
    <button class="btn btn-dark form-control" onclick="uploadFile()">Upload</button>
    <br/><br/>
    <ul id="fileList">
        <!-- List of files will be displayed here -->
    </ul>

</div>

<!-- Bootstrap Modal for Image Zooming -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img style="width: 100%; height: auto; background-position: center; background-repeat: no-repeat; background-size: cover; position: relative;" src="" id="zoomedImage" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script>
    // Handle modal image zooming
    $('#imageModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var imageUrl = button.attr('href');
        var modal = $(this);
        modal.find('.modal-body #zoomedImage').attr('src', imageUrl);
    });
</script>



    <script>
        // Fetch and display the list of files
        $(document).ready(function() {
            $.ajax({
                url: 'fetch_files.php',
                type: 'GET',
                success: function(response) {
                    $('#fileList').html(response);
                }
            });
        });

        // Function to upload a file
        function uploadFile() {
            var fileInput = document.getElementById('fileInput');
            var file = fileInput.files[0];
            var formData = new FormData();
            formData.append('file', file);

            $.ajax({
                url: 'upload.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#fileList').html(response);
                }
            });
        }

        // Function to delete a file
        function deleteFile(filename) {
            $.ajax({
                url: 'delete.php',
                type: 'POST',
                data: { file: filename },
                success: function(response) {
                    $('#fileList').html(response);
                }
            });
        }

        // Function to rename a file
        function renameFile(oldName, newName) {
            $.ajax({
                url: 'rename.php',
                type: 'POST',
                data: { oldName: oldName, newName: newName },
                success: function(response) {
                    $('#fileList').html(response);
                }
            });
        }

        // Function to copy file URL to clipboard
        function copyFileUrl(fileUrl) {
            navigator.clipboard.writeText(fileUrl)
                .then(() => {
                    alert('File URL copied to clipboard: ' + fileUrl);
                })
                .catch(err => {
                    console.error('Failed to copy: ', err);
                });
        }
    </script>
    <?php require_once '../layout/footer.php'; ?>
</body>
</html>