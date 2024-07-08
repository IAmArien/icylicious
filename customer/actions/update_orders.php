<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['order_id'])) {
        $order_id = intval($conn->real_escape_string($_POST['order_id']));
        $update_query = "UPDATE orders SET order_status = ? WHERE id = ?";
        $status = "CANCELLED";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('ss', $status, $order_id);
        $result = $stmt->execute();
        if ($result == 1) {
          $_SESSION['update_orders'] = "Order was cancelled.";
          $stmt->close();
          $conn->close();
          header('Location: ../account_orders/');
        } else {
          unset($_SESSION['update_orders']);
          $_SESSION['errors.type'] = 'update_orders_error';
          $_SESSION['errors.title'] = 'Something went wrong';
          $_SESSION['errors.message'] = 'Unable to cancel your order, might be missing some required parameters';
        }
        header('Location: ../account_orders/');
      } else {
        unset($_SESSION['update_orders']);
        $_SESSION['errors.type'] = 'update_orders_error';
        $_SESSION['errors.title'] = 'Something went wrong';
        $_SESSION['errors.message'] = 'Unable to cancel your order, might be missing some required parameters';
        header('Location: ../account_orders/');
      }
    } else {
      unset($_SESSION['update_orders']);
      $_SESSION['errors.type'] = 'update_orders_error';
      $_SESSION['errors.title'] = 'Something went wrong';
      $_SESSION['errors.message'] = 'Unable to cancel your order, might be missing some required parameters';
      header('Location: ../account_orders/');
    }
  } catch (\Throwable $th) {
    unset($_SESSION['update_orders']);
    echo $th;
  }
?>
