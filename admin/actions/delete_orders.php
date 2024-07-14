<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['user_email'])) {
        $customer_email = $conn->real_escape_string($_POST['user_email']);

        $delete_query = "DELETE FROM cart WHERE user_email = '".$customer_email."'";
        $conn->query($delete_query);

        unset($_SESSION['errors.type']);
        unset($_SESSION['errors.title']);
        unset($_SESSION['errors.message']);
        header('Location: ../pos/');
      } else {
        $_SESSION['errors.type'] = 'add_order_error';
        $_SESSION['errors.title'] = 'Something went wrong';
        $_SESSION['errors.message'] = 'Unable to delete to cart, might be missing some required parameters';
        header('Location: ../pos/');
      }
    } else {
      $_SESSION['errors.type'] = 'add_order_error';
      $_SESSION['errors.title'] = 'Something went wrong';
      $_SESSION['errors.message'] = 'Unable to delete to cart, might be missing some required parameters';
      header('Location: ../pos/');
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>
