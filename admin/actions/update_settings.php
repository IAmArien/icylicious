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
          $_SESSION['user_info.first_name'] = $first_name;
          $_SESSION['user_info.last_name'] = $last_name;
          $_SESSION['user_info.phone'] = $phone;
          $_SESSION['user_info.address'] = $address;
          $_SESSION['user_info.gender'] = $gender;
          $_SESSION['user_info.birthdate'] = $birthdate;
          // Update Logs
          $activity = "Update Settings";
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
        } else {
          $_SESSION['errors.type'] = 'update_settings_error';
          $_SESSION['errors.title'] = 'Something went wrong';
          $_SESSION['errors.message'] = 'Unable to update settings, please check user info if email already exists.';
        }
        header('Location: ../settings/');
      } else {
        $_SESSION['errors.type'] = 'update_settings_error';
        $_SESSION['errors.title'] = 'Something went wrong';
        $_SESSION['errors.message'] = 'Unable to update settings, might be missing some required parameters';
        header('Location: ../settings/');
      }
    } else {
      $_SESSION['errors.type'] = 'update_settings_error';
      $_SESSION['errors.title'] = 'Something went wrong';
      $_SESSION['errors.message'] = 'Unable to update settings, might be missing some required parameters';
      header('Location: ../settings/');
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>
