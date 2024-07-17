<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (
        isset($_POST['order_id']) &&
        isset($_POST['order_status'])
      ) {
        $order_status = $conn->real_escape_string($_POST['order_status']);
        $order_id = intval($_POST['order_id']);
        $update_query = "UPDATE orders SET order_status = '".$order_status."' WHERE id = ".$order_id."";
        $conn->query($update_query);
        // Update Logs
        $activity = "Update Order";
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
        header('Location: ../orders/');
      }
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>