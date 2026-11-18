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
    <title>General Blog Settings</title>
    <link rel="stylesheet" type="text/css" href="../css/custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php require_once '../layout/header-admin-fm.php'; ?>
</head>
<body class="admin-body">
    <?php require_once '../layout/navbar-admin-fm.php'; ?>
    <main class="admin-page">
    <h1>Settings</h1>
    <p class="admin-lead">Title, address, and the text people see before they sign in.</p>
    <div class="admin-panel">
    <form id="settings-form">
        <label for="site-title">Blog title</label>
        <input class="form-control" type="text" id="site-title" name="site-title" />

        <label for="copyright-info">Copyright name</label>
        <input class="form-control" type="text" id="copyright-info" name="copyright-info" />

        <label for="website-url">Blog URL <span class="hint">Detected from this install, including a subfolder.</span></label>
        <input class="form-control" type="text" id="website-url" value="" readonly>

        <label for="greeting-txt">Login greeting</label>
        <input class="form-control" type="text" id="greeting-txt" name="greeting-txt" />

        <label for="meta-txt-desc">Meta description</label>
        <input class="form-control" type="text" id="meta-txt-desc" name="meta-txt-desc" />

        <label for="meta-img">Meta image URL</label>
        <input class="form-control" type="text" id="meta-img" name="meta-img" />

        <button class="admin-save" type="submit">Save settings</button>
        <p class="admin-note" id="save-note" hidden></p>
    </form>

    
    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'get_settings.php', // PHP file to retrieve settings from XML
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#site-title').val(data.title);
                    $('#copyright-info').val(data.copyright);
                    $('#website-url').val(data.websiteurl);
                    $('#greeting-txt').val(data.greetingtxt);
                    $('#meta-txt-desc').val(data.metatxtdesc);
                    $('#meta-img').val(data.metaimg);

                },
                error: function() {
                    console.log('Error fetching settings');
                }
            });
            
            $('#settings-form').submit(function(e) {
                e.preventDefault();
                
                var formData = $(this).serialize();
                
                $.ajax({
                    url: 'save_settings.php', // PHP file to save settings to XML
                    type: 'POST',
                    data: formData,
                    success: function() {
                        $('#save-note').text('Saved.').prop('hidden', false);
                    },
                    error: function() {
                        $('#save-note').text('Could not save. Try again.').prop('hidden', false);
                    }
                });
            });
        });
    </script>

    </div>
    </main>
    <?php require_once '../layout/footer.php'; ?>
</body>
</html>
