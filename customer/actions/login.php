<?php
  include('../../utils/connections.php');
  session_start();
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
      isset($_POST['username']) &&
      isset($_POST['password']) &&
      isset($_POST['type'])
    ) {
      $username = $conn->real_escape_string($_POST['username']);
      $password = $conn->real_escape_string(md5($_POST['password']));
      $type = $conn->real_escape_string($_POST['type']);
      $fetch_credentials = "
        SELECT * FROM user_credentials 
        WHERE username = '".$username."' AND 
        password = '".$password."' AND 
        type = '".$type."' LIMIT 1";
      $result = $conn->query($fetch_credentials);
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row["user_id"];
        $fetch_user_info = "
          SELECT * FROM user_info 
          WHERE id = ".$user_id." 
          LIMIT 1";
        $result = $conn->query($fetch_user_info);
        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $_SESSION['user_info.user_id'] = $row['id'];
          $_SESSION['user_info.first_name'] = $row['first_name'];
          $_SESSION['user_info.last_name'] = $row['last_name'];
          $_SESSION['user_info.email'] = $row['email'];
          $_SESSION['user_info.phone'] = $row['phone'];
          $_SESSION['user_info.address'] = $row['address'];
          $_SESSION['user_info.gender'] = $row['gender'];
          $_SESSION['user_info.birthdate'] = $row['birthdate'];
          $_SESSION['user_credentials.username'] = $username;
          $_SESSION['user_credentials.type'] = $type;
          unset($_SESSION['errors.type']);
          unset($_SESSION['errors.title']);
          unset($_SESSION['errors.message']);
          header('Location: ../../');
        } else {
          $_SESSION['errors.type'] = 'user_credentials';
          $_SESSION['errors.title'] = 'Incorrect Credentials';
          $_SESSION['errors.message'] = 'Invalid username or password';
          header('Location: ../../');
        }
      } else {
        $_SESSION['errors.type'] = 'user_credentials';
        $_SESSION['errors.title'] = 'Incorrect Credentials';
        $_SESSION['errors.message'] = 'Invalid username or password';
        header('Location: ../../');
      }
    } else {
      header('Location: ../../');
    }
  } else {
    header('Location: ../../');
  }
?>
