<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['user_email'])) {
        $customer_email = $conn->real_escape_string($_POST['user_email']);

        $delete_query = "DELETE FROM cart WHERE user_email = '".$customer_email."'";
        $conn->query($delete_query);

        // Update Logs
        $activity = "Delete Orders";
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

        unset($_SESSION['errors.type']);
        unset($_SESSION['errors.title']);
        unset($_SESSION['errors.message']);
        header('Location: ../pos/');
      } else {
        $_SESSION['errors.type'] = 'add_order_error';
        $_SESSION['errors.title'] = 'Something went wrong';
        $_SESSION['errors.message'] = 'Unable to delete to cart, might be missing some required parameters';
        header('Location: ../pos/');
      }
    } else {
      $_SESSION['errors.type'] = 'add_order_error';
      $_SESSION['errors.title'] = 'Something went wrong';
      $_SESSION['errors.message'] = 'Unable to delete to cart, might be missing some required parameters';
      header('Location: ../pos/');
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>
