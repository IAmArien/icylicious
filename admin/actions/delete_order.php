<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (
        isset($_GET['product_id']) &&
        isset($_GET['user_email'])
      ) {
        $product_id = intval($conn->real_escape_string($_GET['product_id']));
        $customer_email = $conn->real_escape_string($_GET['user_email']);

        $delete_query = "DELETE FROM cart WHERE product_id = ".$product_id." AND user_email = '".$customer_email."'";
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
