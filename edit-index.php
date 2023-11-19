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
        header("location:login.php");
        exit;
    }
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php require_once 'layout/header-admin.php'; ?>
    <!-- Include Ace editor library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js"></script>
    <style>
        /* Set a height for the editor */
        #editor {
            width: 100%;
            height: 500px;
        }
    </style>
</head>
<body>
    <?php require_once 'layout/navbar-admin.php'; ?>
    <br /><br/>
    <h1 class="mx-auto" style="text-align: center;color:white;"><i class="fa-solid fa-code" style="color: #ffc107;"></i>  Edit Homepage <br /><a href="add-article.php" class="btn btn-dark"><i class="fa-solid fa-feather" style="color: #ffc107;"></i> Add Article</a> <a href="design-blog.php" class="btn btn-dark"><i class="fa-solid fa-brush" style="color: #ffc107;"></i> Design Blog</a> <a href="editor-js.php" class="btn btn-dark"><i class="fa-brands fa-js" style="color: #ffc107;"></i> Custom JS</a> <a href="editor-css.php" class="btn btn-dark"><i class="fa-brands fa-css3" style="color: #ffc107;"></i> Custom CSS</a> <a href="admin-edit.php" class="btn btn-dark"><i class="fa-solid fa-pen-to-square" style="color: #ffc107;"></i> Edit Articles</a> <a href="blog.php" class="btn btn-dark"><i class="fa-regular fa-rectangle-list" style="color: #ffc107;"></i> Blog</a></h1>
    <br />


    <div class="container" style="background:#2f3129;padding:50px;border-radius:10px;">

    <!-- Ace editor container -->
    <div id="editor"></div>

    <!-- Save button -->
    <br/>
    <button class="btn btn-dark" id="save-button">Save</button>

    </div>

    <script>
        window.onload = function() {
            // Initialize Ace editor
            var editor = ace.edit("editor");
            editor.setTheme("ace/theme/monokai"); // Set the editor theme
            editor.session.setMode("ace/mode/php"); // Set the language mode to PHP

            // Load content of index.php into the editor
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    editor.setValue(this.responseText);
                }
            };
            xhttp.open("GET", "index.php", true);
            xhttp.send();

            // Save edited content on button click
            document.getElementById("save-button").addEventListener("click", function() {
                var editedContent = editor.getValue();

                var xhttpSave = new XMLHttpRequest();
                xhttpSave.onreadystatechange = function() {
                    if (this.readyState === 4) {
                        if (this.status === 200) {
                            console.log("Content saved successfully");
                        } else {
                            console.error("Failed to save content");
                        }
                    }
                };
                xhttpSave.open("POST", "save_index.php", true);
                xhttpSave.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttpSave.send("content=" + encodeURIComponent(editedContent));
            });
        };
    </script>
</body>
</html>
