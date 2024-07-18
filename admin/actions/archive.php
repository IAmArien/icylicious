<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (
        isset($_POST['product_id']) &&
        isset($_POST['archive_status']) &&
        isset($_POST['redirection'])
      ) {
        $product_id = intval($conn->real_escape_string($_POST['product_id']));
        $product_status = $conn->real_escape_string($_POST['archive_status']);
        $redirection = $conn->real_escape_string($_POST['redirection']);
        $update_query = "UPDATE products_info SET product_status = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('ss', $product_status, $product_id);
        $result = $stmt->execute();
        if ($result == 1) {
          // Update Logs
          $activity = "Archived Product: ".$product_id;
          if ($archive_status == 'ACTIVE') {
            $activity = "Unarchived Product: ".$product_id;
          }
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
          $stmt->close();
          $conn->close();
          header('Location: ../'.$redirection);
        } else {
          $_SESSION['errors.type'] = 'archive_error';
          $_SESSION['errors.title'] = 'Something went wrong';
          $_SESSION['errors.message'] = 'Unable to archive product, might be missing some required parameters';
          header('Location: ../'.$redirection);
        }
      } else {
        $_SESSION['errors.type'] = 'archive_error';
        $_SESSION['errors.title'] = 'Something went wrong';
        $_SESSION['errors.message'] = 'Unable to archive product, might be missing some required parameters';
        header('Location: ../products/');
      }
    } else {
      $_SESSION['errors.type'] = 'archive_error';
      $_SESSION['errors.title'] = 'Something went wrong';
      $_SESSION['errors.message'] = 'Unable to archive product, might be missing some required parameters';
      header('Location: ../products/');
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>
