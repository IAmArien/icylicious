<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (
        isset($_POST['type']) &&
        isset($_POST['variant']) &&
        isset($_POST['description'])
      ) {
        $type = $conn->real_escape_string($_POST['type']);
        $variant = $conn->real_escape_string($_POST['variant']);
        $description = $conn->real_escape_string($_POST['description']);
        $status = 0;
        if (isset($_POST['status'])) {
          $status = 1;
        }
        $insert_query = "
          INSERT INTO variants (
            variant_type,
            variant_name,
            variant_description,
            is_enabled
          ) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param(
          'ssss',
          $type,
          $variant,
          $description,
          $status
        );
        $result = $stmt->execute();
        if ($result == 1) {
          unset($_SESSION['errors.type']);
          unset($_SESSION['errors.title']);
          unset($_SESSION['errors.message']);
        } else {
          $_SESSION['errors.type'] = 'variant_error';
          $_SESSION['errors.title'] = 'Something went wrong';
          $_SESSION['errors.message'] = 'Unable to add new variant, might be missing some required parameters';
        }
        header('Location: ../variants/');
      } else {
        $_SESSION['errors.type'] = 'variant_error';
        $_SESSION['errors.title'] = 'Something went wrong';
        $_SESSION['errors.message'] = 'Unable to add new variant, might be missing some required parameters';
        header('Location: ../variants/');
      }
    } else {
      $_SESSION['errors.type'] = 'variant_error';
      $_SESSION['errors.title'] = 'Something went wrong';
      $_SESSION['errors.message'] = 'Unable to add new variant, might be missing some required parameters';
      header('Location: ../variants/');
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>
