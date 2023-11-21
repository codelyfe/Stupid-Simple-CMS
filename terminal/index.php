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
    <title>Server File Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php require_once '../layout/header-admin-fm.php'; ?>
    <style>
        /* Terminal styles */
        #terminal {
            width: 80%;
            height: 500px;
            margin: 20px auto;
            border: 1px solid #ccc;
            overflow-y: auto;
            padding: 10px;
            background-color: #000;
            color: #fff;
        }
        #terminal-input {
            width: 100%;
            background-color: var(--bs-gray-500);
            border: none;
            color: var(--bs-black);
        }
    </style>
</head>
<body>
<?php require_once '../layout/navbar-admin-fm.php'; ?>
<br /><br/>
<h1 class="mx-auto" style="text-align: center;color:white;"><i class="fa-solid fa-code" style="color: #ffc107;"></i>  Terminal <br />
<a href="<?php echo $websiteUrl; ?>add-article.php" class="btn btn-dark"><i class="fa-solid fa-feather" style="color: #ffc107;"></i> Add Article</a> 
<a href="<?php echo $websiteUrl; ?>design-blog.php" class="btn btn-dark"><i class="fa-solid fa-brush" style="color: #ffc107;"></i> Design Blog</a> 
<a href="<?php echo $websiteUrl; ?>editor-js.php" class="btn btn-dark"><i class="fa-brands fa-js" style="color: #ffc107;"></i> Custom JS</a> 
<a href="<?php echo $websiteUrl; ?>editor-css.php" class="btn btn-dark"><i class="fa-brands fa-css3" style="color: #ffc107;"></i> Custom CSS</a> 
<a href="<?php echo $websiteUrl; ?>admin-edit.php" class="btn btn-dark"><i class="fa-solid fa-pen-to-square" style="color: #ffc107;"></i> Edit Articles</a> 
<a href="<?php echo $websiteUrl; ?>index.php" class="btn btn-dark"><i class="fa-regular fa-rectangle-list" style="color: #ffc107;"></i> Blog</a></h1>
<br />

    <div id="terminal">



        <pre id="terminal-output">
            <!-- Terminal output goes here -->
        </pre>
        <form id="command-form" action="" method="post">
            <input type="text" id="terminal-input" name="command" autofocus autocomplete="off" placeholder="PRESS ENTER TO SUBMIT">
        </form>
        <br/>
        <label for="directory-path">Directory Path:</label>
        <input type="text" id="directory-path" placeholder="Example: ../">
        <button class="btn btn-dark" id="change-path">Change Path</button>

        <script>
            $(document).ready(function() {
                $('#change-path').on('click', function() {
                    var newPath = $('#directory-path').val();
                    $.ajax({
                        type: 'POST',
                        url: 'save_directory.php',
                        data: { path: newPath },
                        success: function(response) {
                            alert('Directory path updated successfully!');
                        },
                        error: function(xhr, status, error) {
                            console.error('Error updating directory path:', error);
                        }
                    });
                });
            });
        </script>



    </div>



    
    <div class="container" style="background-color:white;padding:50px;border-radius:10px;margin-bottom:50px;">

    <code>
    <?php
    $filename = 'help.txt';
    $fileContent = file_get_contents($filename);

    // Check if the file content was read successfully
    if ($fileContent !== false) {
        echo nl2br($fileContent); // Use nl2br to display line breaks in HTML
    } else {
        echo 'Failed to read the file.';
    }
    ?> 
    </code>

    </div>





    <script>
        const form = document.getElementById('command-form');
        const output = document.getElementById('terminal-output');

        form.addEventListener('submit', function(event) {
            event.preventDefault();
            const input = document.getElementById('terminal-input').value;
            fetch('handle-command.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `command=${encodeURIComponent(input)}`
            })
            .then(response => response.text())
            .then(data => {
                output.innerHTML += `<div>${input}</div><div>${data}</div>`;
                document.getElementById('terminal-input').value = '';
                document.getElementById('terminal').scrollTop = document.getElementById('terminal').scrollHeight;
            });
        });
    </script>
    <?php require_once '../layout/footer.php'; ?>
</body>
</html>