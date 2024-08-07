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
        isset($_POST['birth_date']) &&
        isset($_POST['password'])
      ) {
        $first_name = $conn->real_escape_string($_POST['first_name']);
        $last_name = $conn->real_escape_string($_POST['last_name']);
        $email = $conn->real_escape_string($_POST['email']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $address = $conn->real_escape_string($_POST['address']);
        $gender = $conn->real_escape_string($_POST['gender']);
        $birth_date = $conn->real_escape_string($_POST['birth_date']);
        $password = $conn->real_escape_string($_POST['password']);
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
          $user_type = 'customer';
          $hashed_password = md5($password);
          $stmt->bind_param(
            'ssss',
            $row['id'],
            $row['email'],
            $hashed_password,
            $user_type
          );
          $result = $stmt->execute();
          if ($result == 1) {
            $_SESSION['sign_up'] = "Registered successfully. Please try logging in.";
            unset($_SESSION['errors.type']);
            unset($_SESSION['errors.title']);
            unset($_SESSION['errors.message']);
            $stmt->close();
            $conn->close();
          } else {
            unset($_SESSION['sign_up']);
            $_SESSION['errors.type'] = 'registration_error';
            $_SESSION['errors.title'] = 'Something went wrong';
            $_SESSION['errors.message'] = 'Unable to register, please check user info if email already exists.';
          }
        } else {
          unset($_SESSION['sign_up']);
          $_SESSION['errors.type'] = 'registration_error';
          $_SESSION['errors.title'] = 'Something went wrong';
          $_SESSION['errors.message'] = 'Unable to register, please check user info if email already exists.';
        }
        header('Location: ../../');
      } else {
        unset($_SESSION['sign_up']);
        $_SESSION['errors.type'] = 'registration_error';
        $_SESSION['errors.title'] = 'Something went wrong';
        $_SESSION['errors.message'] = 'Unable to register, might be missing some required parameters';
        header('Location: ../../');
      }
    } else {
      unset($_SESSION['sign_up']);
      $_SESSION['errors.type'] = 'registration_error';
      $_SESSION['errors.title'] = 'Something went wrong';
      $_SESSION['errors.message'] = 'Unable to register, might be missing some required parameters';
      header('Location: ../../');
    }
  } catch (\Throwable $th) {
    unset($_SESSION['sign_up']);
    echo $th;
  }
?>
