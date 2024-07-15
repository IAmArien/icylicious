<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if (
      isset($_POST['payment_type']) &&
      isset($_POST['user_email']) &&
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
      isset($_POST['order_total']) &&
      isset($_POST['payment']) &&
      isset($_POST['order_status'])
    ) {
      $payment_type = $conn->real_escape_string($_POST['payment_type']);
      $customer_email = $conn->real_escape_string($_POST['user_email']);
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
      $payment = $conn->real_escape_string($_POST['payment']);
      $order_status = $conn->real_escape_string($_POST['order_status']);

      $fetch_query = "SELECT * FROM cart WHERE user_email = '".$customer_email."'";
      $result = $conn->query($fetch_query);
      $transaction_id = uniqid();
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $product_id = intval($row['product_id']);
          $variant_id = intval($row['variant_id']);
          $user_id = $row['user_id'];
          $order_quantity = $row['order_quantity'];
          $is_pickup = $row['is_pickup'];
          $user_address = $row['user_address'];
          $user_phone = $row['user_phone'];
          $user_email = $row['user_email'];
          $order_type = "POS";

          $product_name = "";
          $variant_type = "";
          $variant_name = "";
          $variant_price = "";
          $user_firstname = "";
          $user_lastname = "";

          $fetch_query = "SELECT * FROM products_info WHERE id = ".$product_id." LIMIT 1";
          $product_info_result = $conn->query($fetch_query);
          if ($product_info_result->num_rows > 0) {
            $product_info_row = $product_info_result->fetch_assoc();
            $product_name = $product_info_row['product_name'];
          }

          $fetch_query = "SELECT * FROM variants WHERE id = ".$variant_id." LIMIT 1";
          $variant_result = $conn->query($fetch_query);
          if ($variant_result->num_rows > 0) {
            $variant_row = $variant_result->fetch_assoc();
            $variant_type = $variant_row['variant_type'];
            $variant_name = $variant_row['variant_name'];
          }

          $fetch_query = "SELECT * FROM products_prices WHERE product_id = ".$product_id." LIMIT 1";
          $product_price_result = $conn->query($fetch_query);
          if ($product_price_result->num_rows > 0) {
            $product_price_row = $product_price_result->fetch_assoc();
            $variant_price = $product_price_row['variant_price'];
          }

          $fetch_query = "SELECT * FROM user_info WHERE email = '".$customer_email."' LIMIT 1";
          $user_info_result = $conn->query($fetch_query);
          if ($user_info_result->num_rows > 0) {
            $user_info_row = $user_info_result->fetch_assoc();
            $user_firstname = $user_info_row['first_name'];
            $user_lastname = $user_info_row['last_name'];
          }

          $insert_query = "INSERT INTO orders (
              transaction_id,
              product_id,
              product_name,
              variant_id,
              variant_type,
              variant_name,
              variant_price,
              user_id,
              order_date,
              order_time,
              order_quantity,
              is_pickup,
              user_firstname,
              user_lastname,
              user_address,
              user_phone,
              user_email,
              order_status,
              order_total,
              order_type
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
          $order_date = date("Y/m/d");
          $order_time = date("h:i:sa");
          $stmt = $conn->prepare($insert_query);
          $stmt->bind_param(
            'ssssssssssssssssssss',
            $transaction_id,
            $product_id,
            $product_name,
            $variant_id,
            $variant_type,
            $variant_name,
            $variant_price,
            $user_id,
            $order_date,
            $order_time,
            $order_quantity,
            $is_pickup,
            $user_firstname,
            $user_lastname,
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
                $payment,
                $customer_email
              );
              $stmt->execute();
            }
          }
        }
        $delete_query = "DELETE FROM cart WHERE user_email = '".$customer_email."'";
        $conn->query($delete_query);
      }
      unset($_SESSION['errors.type']);
      unset($_SESSION['errors.title']);
      unset($_SESSION['errors.message']);
      $_SESSION['checkout.transaction_id'] = $transaction_id;
      header('Location: ../pos/');
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>
