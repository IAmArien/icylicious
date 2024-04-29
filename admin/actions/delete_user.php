<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $delete_info_query = "DELETE FROM user_info WHERE email = '".$email."'";
        $delete_cred_query = "DELETE FROM user_credentials WHERE username = '".$email."'";
        $conn->query($delete_info_query);
        $conn->query($delete_cred_query);
        header('Location: ../users/');
      }
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>