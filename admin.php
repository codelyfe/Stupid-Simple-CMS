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
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php require_once 'layout/header-admin.php'; ?>
</head>
<body>
<?php require_once 'layout/body-admin.php'; ?>

<div class="container-fluid" style="background-color:white;">
    <h1>Admin Panel</h1>
    <label for="background_color">Background Color:</label>
    <input type="color" id="background_color">
    <button onclick="changeBackgroundColor()">Change Color</button><br><br>

    <label for="background_image">Background Image URL:</label>
    <input type="text" id="background_image_url">
    <button onclick="changeBackgroundImage()">Change Image</button><br><br>
</div>

    <script>
        function changeBackgroundColor() {
            var color = $('#background_color').val();
            $.ajax({
                type: 'POST',
                url: 'save_changes.php',
                data: { background: color },
                success: function(response) {
                    alert('Background color changed successfully!');
                },
                error: function(xhr, status, error) {
                    console.error('Error changing background color:', error);
                }
            });
        }

        function changeBackgroundImage() {
            var imageUrl = $('#background_image_url').val();
            $.ajax({
                type: 'POST',
                url: 'save_changes.php',
                data: { background_image_url: imageUrl },
                success: function(response) {
                    alert('Background image changed successfully!');
                },
                error: function(xhr, status, error) {
                    console.error('Error changing background image:', error);
                }
            });
        }
    </script>
</body>
</html>

