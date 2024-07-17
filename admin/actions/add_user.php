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
        $insert_query = "
          INSERT INTO user_info (
            first_name,
            last_name,
            email,
            phone,
            address,
            gender,
            birth_date  
          ) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param(
          'sssssss',
          $first_name,
          $last_name,
          $email,
          $phone,
          $address,
          $gender,
          $birth_date
        );
        $result = $stmt->execute();
        if ($result == 1) {
          $fetch_query = "
            SELECT id, email FROM user_info 
            WHERE email = '".$email."' 
            LIMIT 1";
          $result = $conn->query($fetch_query);
          $insert_query = "
            INSERT INTO user_credentials (
              user_id,
              username,
              password,
              type
            ) VALUES (?, ?, ?, ?)";
          $stmt = $conn->prepare($insert_query);
          $row = $result->fetch_assoc();
          $temp_password = md5('temporary_password');
          $user_type = 'customer';
          $stmt->bind_param(
            'ssss',
            $row['id'],
            $row['email'],
            $temp_password,
            $user_type
          );
          $result = $stmt->execute();
          if ($result == 1) {
            // Update Logs
            $activity = "Add User";
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
            $_SESSION['errors.type'] = 'registration_error';
            $_SESSION['errors.title'] = 'Something went wrong';
            $_SESSION['errors.message'] = 'Unable to add new user, please check user info if email already exists.';
          }
        } else {
          $_SESSION['errors.type'] = 'registration_error';
          $_SESSION['errors.title'] = 'Something went wrong';
          $_SESSION['errors.message'] = 'Unable to add new user, please check user info if email already exists.';
        }
        header('Location: ../users/');
      } else {
        $_SESSION['errors.type'] = 'registration_error';
        $_SESSION['errors.title'] = 'Something went wrong';
        $_SESSION['errors.message'] = 'Unable to add new user, might be missing some required parameters';
        header('Location: ../users/');
      }
    } else {
      $_SESSION['errors.type'] = 'registration_error';
      $_SESSION['errors.title'] = 'Something went wrong';
      $_SESSION['errors.message'] = 'Unable to add new user, might be missing some required parameters';
      header('Location: ../users/');
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>
