<?php
  include('../../utils/connections.php');
  session_start();
  unset($_SESSION['user_info.user_id']);
  unset($_SESSION['user_info.first_name']);
  unset($_SESSION['user_info.last_name']);
  unset($_SESSION['user_info.email']);
  unset($_SESSION['user_info.phone']);
  unset($_SESSION['user_info.address']);
  unset($_SESSION['user_info.gender']);
  unset($_SESSION['user_info.birthdate']);
  unset($_SESSION['user_credentials.username']);
  unset($_SESSION['user_credentials.type']);
  unset($_SESSION['errors.type']);
  unset($_SESSION['errors.title']);
  unset($_SESSION['errors.message']);
  header('Location: ../');
?>
