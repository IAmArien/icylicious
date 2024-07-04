<?php
  include('../../utils/connections.php');
  session_start();
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
      isset($_POST['product_id']) &&
      isset($_POST['customer_email'])
    ) {
      $customer_email = $conn->real_escape_string($_POST['customer_email']);
      $product_id = intval($conn->real_escape_string($_POST['product_id']));
      $delete_query = "DELETE FROM cart WHERE product_id = ".$product_id." AND user_email = '".$customer_email."'";
      $conn->query($delete_query);
      unset($_SESSION['errors.type']);
      unset($_SESSION['errors.title']);
      unset($_SESSION['errors.message']);
      $_SESSION['cart.message'] = 'Cart item was removed successfully!';
      header('Location: ../cart/');
    } else {
      $_SESSION['errors.type'] = 'checkout';
      $_SESSION['errors.title'] = 'Unable to delete item from cart';
      $_SESSION['errors.message'] = 'Something went wrong, unable to delete item from cart for this product.';
      header('Location: ../cart/');
    }
  }
?>
