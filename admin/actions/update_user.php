<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (
        isset($_POST['user_id']) &&
        isset($_POST['user_email']) &&
        isset($_POST['first_name']) &&
        isset($_POST['last_name']) &&
        isset($_POST['email']) &&
        isset($_POST['phone']) &&
        isset($_POST['address']) &&
        isset($_POST['gender']) &&
        isset($_POST['birth_date'])
      ) {
        $user_id = $conn->real_escape_string($_POST['user_id']);
        $user_email = $conn->real_escape_string($_POST['user_email']);
        $first_name = $conn->real_escape_string($_POST['first_name']);
        $last_name = $conn->real_escape_string($_POST['last_name']);
        $email = $conn->real_escape_string($_POST['email']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $address = $conn->real_escape_string($_POST['address']);
        $gender = $conn->real_escape_string($_POST['gender']);
        $birth_date = $conn->real_escape_string($_POST['birth_date']);
        $update_query = "
          UPDATE user_info SET 
          first_name = ?,
          last_name = ?,
          phone = ?,
          address = ?,
          gender = ?,
          birth_date = ? 
          WHERE id = ? AND email = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param(
          'ssssssss',
          $first_name,
          $last_name,
          $phone,
          $address,
          $gender,
          $birth_date,
          $user_id,
          $user_email
        );
        $result = $stmt->execute();
        if ($result == 1) {
          unset($_SESSION['errors.type']);
          unset($_SESSION['errors.title']);
          unset($_SESSION['errors.message']);
          $stmt->close();
          $conn->close();
        } else {
          $_SESSION['errors.type'] = 'update_user_error';
          $_SESSION['errors.title'] = 'Something went wrong';
          $_SESSION['errors.message'] = 'Unable to update user, please check user info if email already exists.';
        }
        header('Location: ../users/');
      } else {
        $_SESSION['errors.type'] = 'update_user_error';
        $_SESSION['errors.title'] = 'Something went wrong';
        $_SESSION['errors.message'] = 'Unable to update user, might be missing some required parameters';
        header('Location: ../users/');
      }
    } else {
      $_SESSION['errors.type'] = 'update_user_error';
      $_SESSION['errors.title'] = 'Something went wrong';
      $_SESSION['errors.message'] = 'Unable to update user, might be missing some required parameters';
      header('Location: ../users/');
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>
