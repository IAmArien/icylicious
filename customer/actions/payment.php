<?php
  include('../../utils/connections.php');
  session_start();
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
      isset($_POST['payment_type']) &&
      isset($_POST['customer_email']) &&
      isset($_POST['credit_card_no']) &&
      isset($_POST['credit_card_exp']) &&
      isset($_POST['credit_card_code']) &&
      isset($_POST['billing_first_name']) &&
      isset($_POST['billing_last_name']) &&
      isset($_POST['billing_phone']) &&
      isset($_POST['billing_address']) &&
      isset($_POST['shipping_first_name']) &&
      isset($_POST['shipping_last_name']) &&
      isset($_POST['shipping_phone']) &&
      isset($_POST['shipping_address']) &&
      isset($_POST['order_total'])
    ) {
      $payment_type = $conn->real_escape_string($_POST['payment_type']);
      $customer_email = $conn->real_escape_string($_POST['customer_email']);
      $credit_card_no = $conn->real_escape_string($_POST['credit_card_no']);
      $credit_card_exp = $conn->real_escape_string($_POST['credit_card_exp']);
      $credit_card_code = $conn->real_escape_string($_POST['credit_card_code']);
      $billing_first_name = $conn->real_escape_string($_POST['billing_first_name']);
      $billing_last_name = $conn->real_escape_string($_POST['billing_last_name']);
      $billing_phone = $conn->real_escape_string($_POST['billing_phone']);
      $billing_address = $conn->real_escape_string($_POST['billing_address']);
      $shipping_first_name = $conn->real_escape_string($_POST['shipping_first_name']);
      $shipping_last_name = $conn->real_escape_string($_POST['shipping_last_name']);
      $shipping_phone = $conn->real_escape_string($_POST['shipping_phone']);
      $shipping_address = $conn->real_escape_string($_POST['shipping_address']);
      $order_total = $conn->real_escape_string($_POST['order_total']);

      $fetch_query = "SELECT * FROM cart WHERE user_email = '".$customer_email."'";
      $result = $conn->query($fetch_query);
      if ($result->num_rows > 0) {
        $transaction_id = uniqid();
        while ($row = $result->fetch_assoc()) {
          $product_id = $row['product_id'];
          $variant_id = $row['variant_id'];
          $user_id = $row['user_id'];
          $order_quantity = $row['order_quantity'];
          $is_pickup = $row['is_pickup'];
          $user_address = $row['user_address'];
          $user_phone = $row['user_phone'];
          $user_email = $row['user_email'];
          $order_status = "PROCESSING";
          $order_type = "ONLINE";
          $insert_query = "INSERT INTO orders (
              transaction_id,
              product_id,
              variant_id,
              user_id,
              order_date,
              order_time,
              order_quantity,
              is_pickup,
              user_address,
              user_phone,
              user_email,
              order_status,
              order_total,
              order_type
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
          $order_date = date("Y/m/d");
          $order_time = date("h:i:sa");
          $stmt = $conn->prepare($insert_query);
          $stmt->bind_param(
            'ssssssssssssss',
            $transaction_id,
            $product_id,
            $variant_id,
            $user_id,
            $order_date,
            $order_time,
            $order_quantity,
            $is_pickup,
            $user_address,
            $user_phone,
            $user_email,
            $order_status,
            $order_total,
            $order_type
          );
          $insert_result = $stmt->execute();
          if ($insert_result == 1) {
            $fetch_query = "SELECT id FROM orders WHERE user_email = '".$user_email."' ORDER BY id DESC LIMIT 1";
            $order_result = $conn->query($fetch_query);
            if ($order_result->num_rows > 0) {
              $order_row = $order_result->fetch_assoc();
              $order_id = $order_row['id'];
              if (isset($_POST['same_as_shipping_address'])) {
                $insert_query = "INSERT INTO orders_billing (
                    order_id,
                    credit_card_no,
                    credit_card_exp,
                    credit_card_code,
                    billing_first_name,
                    billing_last_name,
                    billing_phone,
                    billing_address,
                    shipping_first_name,
                    shipping_last_name,
                    shipping_phone,
                    shipping_address,
                    payment_type,
                    amount_paid,
                    payment,
                    customer_email
                  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                  $stmt = $conn->prepare($insert_query);
                  $stmt->bind_param(
                    'ssssssssssssssss',
                    $order_id,
                    $credit_card_no,
                    $credit_card_exp,
                    $credit_card_code,
                    $billing_first_name,
                    $billing_last_name,
                    $billing_phone,
                    $billing_address,
                    $billing_first_name,
                    $billing_last_name,
                    $billing_phone,
                    $billing_address,
                    $payment_type,
                    $order_total,
                    $order_total
                    $customer_email
                  );
                  $stmt->execute();
              } else {
                $insert_query = "INSERT INTO orders_billing (
                  order_id,
                  credit_card_no,
                  credit_card_exp,
                  credit_card_code,
                  billing_first_name,
                  billing_last_name,
                  billing_phone,
                  billing_address,
                  shipping_first_name,
                  shipping_last_name,
                  shipping_phone,
                  shipping_address,
                  payment_type,
                  amount_paid,
                  payment,
                  customer_email
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($insert_query);
                $stmt->bind_param(
                  'ssssssssssssssss',
                  $order_id,
                  $credit_card_no,
                  $credit_card_exp,
                  $credit_card_code,
                  $billing_first_name,
                  $billing_last_name,
                  $billing_phone,
                  $billing_address,
                  $shipping_first_name,
                  $shipping_last_name,
                  $shipping_phone,
                  $shipping_address,
                  $payment_type,
                  $order_total,
                  $order_total
                  $customer_email
                );
                $stmt->execute();
              }
            }
          }
        }
        $delete_query = "DELETE FROM cart WHERE user_email = '".$customer_email."'";
        $conn->query($delete_query);
      }
      unset($_SESSION['errors.type']);
      unset($_SESSION['errors.title']);
      unset($_SESSION['errors.message']);
      header('Location: ../order/');
    } else {
      $_SESSION['errors.type'] = 'checkout';
      $_SESSION['errors.title'] = 'Unable to checkout';
      $_SESSION['errors.message'] = 'Something went wrong, unable to checkout products.';
      header('Location: ../checkout/');
    }
  } else {
    $_SESSION['errors.type'] = 'checkout';
    $_SESSION['errors.title'] = 'Unable to checkout';
    $_SESSION['errors.message'] = 'Something went wrong, unable to checkout products.';
    header('Location: ../checkout/');
  }
?>
