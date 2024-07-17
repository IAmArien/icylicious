<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['variant_id'])) {
        $variant_id = $_POST['variant_id'];
        $delete_query = "DELETE FROM variants WHERE id = ".$variant_id."";
        $conn->query($delete_query);
        // Update Logs
        $activity = "Delete Variant";
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
        header('Location: ../variants/');
      }
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>