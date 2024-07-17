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
        // Update Logs
        $activity = "Delete User";
        $activity_date = date("Y/m/d");
        $activity_time = date("h:i:sa");
        $user_email = $_SESSION['user_info.email'];
        $user_fullname = $_SESSION['user_info.first_name'].' '.$_SESSION['user_info.last_name'];
        $insert_query = "INSERT INTO activity_log (
            activity,
            activity_date,
            activity_time,
            user_email,
            user_fullname
          ) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param(
          'sssss',
          $activity,
          $activity_date,
          $activity_time,
          $user_email,
          $user_fullname
        );
        $result = $stmt->execute();
        header('Location: ../users/');
      }
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>