<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if (
      isset($_POST['payment_type']) &&
      isset($_POST['user_email']) &&
      isset($_POST['order_status'])
    ) {

    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>
