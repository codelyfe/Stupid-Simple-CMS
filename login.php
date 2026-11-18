  <?php
    /*
    ┏┓┏┓┳┓┏┓┓ ┓┏┏┓┏┓
    ┃ ┃┃┃┃┣ ┃ ┗┫┣ ┣ 
    ┗┛┗┛┻┛┗┛┗┛┗┛┻ ┗┛
    */              
    ?>
<?php include 'text-content/english.php'; ?>
<?php
session_start();
//                      //
// Check if the login form is submitted
if (isset($_POST['Submit'])) {
  // Initialize login attempt counter
  if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
  }
  //                      //
  // Limit the number of login attempts
  if ($_SESSION['login_attempts'] >= 3) {
    $lockoutTime = 60; // Lockout time in seconds (adjust as needed)
    $lastAttemptTime = $_SESSION['last_attempt_time'] ?? 0;

    if (time() - $lastAttemptTime < $lockoutTime) {
      $msg = "<span style='color:red'>Too many login attempts. Please try again later.</span>";
    } else {
      // Reset login attempts after lockout period
      $_SESSION['login_attempts'] = 0;
      login($msg);
    }
  } else {
    login($msg);
  }
}
//                      //
// Function to handle login logic
function login(&$msg)
{
  // Define username and associated password array
  $logins = array(
    'admin' => 'password',
    'admin1' => 'password',
    'admin2' => 'password'
  );
  //                      //
  // Check and assign submitted Username and Password to new variables
  $Username = isset($_POST['Username']) ? $_POST['Username'] : '';
  $Password = isset($_POST['Password']) ? $_POST['Password'] : '';
  //                      //
  // Log login attempt
  logLoginAttempt($Username, $Password);
  //                      //
  // Check Username and Password existence in defined array
  if (isset($logins[$Username]) && $logins[$Username] == $Password) {
    // Authentication successful: Set session variables and redirect to Protected page
    $_SESSION['UserData']['Username'] = $Username;
    session_regenerate_id(); // Regenerate session ID for security
    //                      //
    header("location:add-article.php");
    exit;
  } else {
    // Unsuccessful attempt: Set error message and increment login attempts
    $msg = "<span style='color:red'>Invalid Login Details</span>";
    $_SESSION['login_attempts']++;
    $_SESSION['last_attempt_time'] = time();
  }
}
//                      //
// Function to log login attempts to a text file
function logLoginAttempt($username, $password)
{
  $logFile = 'login_attempts.php';
  //                      //
  // Get the current date and time
  $dateTime = date('Y-m-d H:i:s');
  //                      //
  // Prepare the log message
  $logMessage = "Date: $dateTime, Username: $username, Password: $password\n";
  //                      //
  // Append the log message to the file
  file_put_contents($logFile, $logMessage, FILE_APPEND);
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link href="./css/style.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../vendors/font-awesome-4.7.0/css/font-awesome.min.css">
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      font-family: Arial;
      font-size: 17px;
      background: #161616;
    }
    .content {
      position: fixed;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      color: #f1f1f1;
      width: 100%;
      padding: 20px;
    }
    #myBtn {
      width: 200px;
      font-size: 18px;
      padding: 10px;
      border: none;
      background: #000;
      color: #fff;
      cursor: pointer;
    }
    #myBtn:hover {
      background: #ddd;
      color: black;
    }
  </style>
<?php require_once 'layout/header.php'; ?>
</head>
<body>
<?php require_once 'layout/navbar.php'; ?>
  <div class="login-shell">
    <div class="login-card">
      <h1><?php echo htmlspecialchars((string) $siteTitle); ?></h1>
      <p class="lede"><?php echo htmlspecialchars((string) $greetingTxt); ?></p>
      <form action="" method="post" name="Login_Form">
        <?php if (isset($msg)) { echo $msg; } ?>
        <input name="Username" type="text" class="Input form-control" placeholder="Username" autocomplete="username">
        <input name="Password" type="password" class="Input form-control" placeholder="Password" autocomplete="current-password">
        <input name="Submit" type="submit" value="Login" class="btn-login">
        <p class="lede" style="margin-top:1rem;margin-bottom:0;"><a href="./">Back to the blog</a></p>
      </form>
    </div>
  </div>
</body>
</html>