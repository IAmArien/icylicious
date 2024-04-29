<?php
  session_start();
  include('../utils/connections.php');
  if (
    isset($_SESSION['user_credentials.username']) &&
    isset($_SESSION['user_credentials.type'])
  ) {
    header('Location: ./dashboard');
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/global.css" />
    <link rel="stylesheet" href="./css/index.css" />
  </head>
  <body>
    <form action="./actions/login.php" method="POST">
      <div class="content-wrapper">
        <div class="content-form-wrapper">
          <h2 class="h2-form-title sans-700">ICYLICIOUS&trade;</h2>
          <p class="p-form-title-description sans-regular">
            Please input valid credentials to login
          </p>
          <input type="hidden" name="type" value="admin" />
          <input type="email" name="username" placeholder="Username" required class="sans-regular">
          <input type="password" name="password" placeholder="Password" required class="sans-regular">
          <input type="submit" value="Login" class="login-button sans-700">
          <div class="div-form-footer">
            <p class="p-form-footer-title sans-regular">
              Forgot password? Click <a class="a-form-forgot-password" href="">here</a>.
            </p>
          </div>
        </div>
      </div>
    </form>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>
