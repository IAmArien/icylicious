<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (
        isset($_POST['order_id']) &&
        isset($_POST['order_status'])
      ) {
        $order_status = $conn->real_escape_string($_POST['order_status']);
        $order_id = intval($_POST['order_id']);
        $update_query = "UPDATE orders SET order_status = '".$order_status."' WHERE id = ".$order_id."";
        $conn->query($update_query);
        header('Location: ../orders/');
      }
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>