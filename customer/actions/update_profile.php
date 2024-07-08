<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (
        isset($_POST['first_name']) &&
        isset($_POST['last_name']) &&
        isset($_POST['email']) &&
        isset($_POST['phone']) &&
        isset($_POST['address']) &&
        isset($_POST['gender']) &&
        isset($_POST['birth_date'])
      ) {
        $first_name = $conn->real_escape_string($_POST['first_name']);
        $last_name = $conn->real_escape_string($_POST['last_name']);
        $email = $conn->real_escape_string($_POST['email']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $address = $conn->real_escape_string($_POST['address']);
        $gender = $conn->real_escape_string($_POST['gender']);
        $birth_date = $conn->real_escape_string($_POST['birth_date']);
        $update_query = "UPDATE user_info SET 
            first_name = ?,
            last_name = ?,
            phone = ?,
            address = ?,
            gender = ?,
            birth_date = ? 
            WHERE email = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param(
          'sssssss',
          $first_name,
          $last_name,
          $phone,
          $address,
          $gender,
          $birth_date,
          $email
        );
        $result = $stmt->execute();
        if ($result == 1) {
            $_SESSION['user_info.first_name'] = $first_name;
            $_SESSION['user_info.last_name'] = $last_name;
            $_SESSION['user_info.email'] = $email;
            $_SESSION['user_info.phone'] = $phone;
            $_SESSION['user_info.address'] = $address;
            $_SESSION['user_info.gender'] = $gender;
            $_SESSION['user_info.birthdate'] = $birth_date;
            $_SESSION['sign_up'] = 'Profile updated successfully';
            unset($_SESSION['errors.type']);
            unset($_SESSION['errors.title']);
            unset($_SESSION['errors.message']);
            $stmt->close();
            $conn->close();
            header('Location: ../account/');
        } else {
          unset($_SESSION['sign_up']);
          $_SESSION['errors.type'] = 'update_profile_error';
          $_SESSION['errors.title'] = 'Something went wrong';
          $_SESSION['errors.message'] = 'Unable to update profile, might be missing some required parameters';
        }
        header('Location: ../account/');
      } else {
        unset($_SESSION['sign_up']);
        $_SESSION['errors.type'] = 'update_profile_error';
        $_SESSION['errors.title'] = 'Something went wrong';
        $_SESSION['errors.message'] = 'Unable to update profile 1, might be missing some required parameters';
        header('Location: ../account/');
      }
    } else {
      unset($_SESSION['sign_up']);
      $_SESSION['errors.type'] = 'update_profile_error';
      $_SESSION['errors.title'] = 'Something went wrong';
      $_SESSION['errors.message'] = 'Unable to update profile, might be missing some required parameters';
      header('Location: ../account/');
    }
  } catch (\Throwable $th) {
    unset($_SESSION['sign_up']);
    echo $th;
  }
?>
