<?php
  include('../../utils/connections.php');
  session_start();
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
      isset($_POST['firstname']) &&
      isset($_POST['lastname']) &&
      isset($_POST['email']) &&
      isset($_POST['mobile']) &&
      isset($_POST['subject']) &&
      isset($_POST['description'])
    ) {
      $firstname = $conn->real_escape_string($_POST['firstname']);
      $lastname = $conn->real_escape_string($_POST['lastname']);
      $email = $conn->real_escape_string($_POST['email']);
      $mobile = $conn->real_escape_string($_POST['mobile']);
      $subject = $conn->real_escape_string($_POST['subject']);
      $description = $conn->real_escape_string($_POST['description']);
      $insert_query = "INSERT INTO contact_us (
          firstname,
          lastname,
          email,
          mobile,
          contact_subject,
          contact_description
        ) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($insert_query);
      $stmt->bind_param(
        'ssssss',
        $firstname,
        $lastname,
        $email,
        $mobile,
        $subject,
        $description
      );
      $result = $stmt->execute();
      if ($result == 1) {
        unset($_SESSION['errors.type']);
        unset($_SESSION['errors.title']);
        unset($_SESSION['errors.message']);
        $_SESSION['contact_us'] = "Your message has been successfully sent!";
        header('Location: ../../');
      } else {
        $_SESSION['errors.type'] = 'contact_us';
        $_SESSION['errors.title'] = 'Invalid Contact Form';
        $_SESSION['errors.message'] = 'Invalid Contact Form';
        unset($_SESSION['contact_us']);
        header('Location: ../../');
      }
    } else {
      header('Location: ../../');
    }
  } else {
    header('Location: ../../');
  }
?>
