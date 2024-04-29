<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (
        isset($_POST['variant_id']) &&
        isset($_POST['type']) &&
        isset($_POST['variant']) &&
        isset($_POST['description'])
      ) {
        $variant_id = $conn->real_escape_string($_POST['variant_id']);
        $type = $conn->real_escape_string($_POST['type']);
        $variant = $conn->real_escape_string($_POST['variant']);
        $description = $conn->real_escape_string($_POST['description']);
        $status = 0;
        if (isset($_POST['status'])) {
          $status = 1;
        }
        $update_query = "
          UPDATE variants SET 
          variant_type = ?, 
          variant_name = ?, 
          variant_description = ?, 
          is_enabled = ? 
          WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param(
          'sssss',
          $type,
          $variant,
          $description,
          $status,
          $variant_id
        );
        $result = $stmt->execute();
        if ($result == 1) {
          unset($_SESSION['errors.type']);
          unset($_SESSION['errors.title']);
          unset($_SESSION['errors.message']);
          $stmt->close();
          $conn->close();
          header('Location: ../variants/');
        } else {
          $_SESSION['errors.type'] = 'variant_error';
          $_SESSION['errors.title'] = 'Something went wrong';
          $_SESSION['errors.message'] = 'Unable to update variant, might be missing some required parameters';
          header('Location: ../variants/');
        }
      } else {
        $_SESSION['errors.type'] = 'variant_error';
        $_SESSION['errors.title'] = 'Something went wrong';
        $_SESSION['errors.message'] = 'Unable to update variant, might be missing some required parameters';
        header('Location: ../variants/');
      }
    } else {
      $_SESSION['errors.type'] = 'variant_error';
      $_SESSION['errors.title'] = 'Something went wrong';
      $_SESSION['errors.message'] = 'Unable to update variant, might be missing some required parameters';
      header('Location: ../variants/');
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>
