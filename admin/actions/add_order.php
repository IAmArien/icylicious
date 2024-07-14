<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (
        isset($_POST['product_id']) &&
        isset($_POST['product_quantity']) &&
        isset($_POST['user_email'])
      ) {
        $product_id = intval($conn->real_escape_string($_POST['product_id']));
        $product_quantity = intval($conn->real_escape_string($_POST['product_quantity']));
        $customer_email = $conn->real_escape_string($_POST['user_email']);

        $fetch_query = "SELECT * FROM user_info WHERE email = '".$customer_email."' LIMIT 1";
        $result = $conn->query($fetch_query);
        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $user_id = intval($row['id']);
          $user_phone = $row['phone'];
          $user_address = $row['address'];

          $fetch_query = "SELECT * FROM products_prices WHERE product_id = ".$product_id."";
          $result = $conn->query($fetch_query);
          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $variant_id = intval($row['variant_id']);
            $variant_price = $row['variant_price'];

            $fetch_query = "SELECT * FROM cart WHERE product_id = ".$product_id." AND user_email = '".$customer_email."'";
            $result = $conn->query($fetch_query);
            if ($result->num_rows > 0) {
              $cart_row = $result->fetch_assoc();
              $cart_id = $cart_row['id'];
              $current_quantity = intval($cart_row['order_quantity']);
              $product_quantity = $product_quantity + $current_quantity;
              $update_query = "UPDATE cart SET 
                order_quantity = ?,
                order_date = ?,
                order_time = ?  
                WHERE id = ?";
              $order_date = date("Y/m/d");
              $order_time = date("h:i:sa");
              $stmt = $conn->prepare($update_query);
              $stmt->bind_param(
                'ssss',
                $product_quantity,
                $order_date,
                $order_time,
                $cart_id
              );
            } else {
              $insert_query = "INSERT INTO cart (
                product_id,
                variant_id,
                user_id,
                order_date,
                order_time,
                order_quantity,
                is_pickup,
                user_address,
                user_phone,
                user_email
              ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
              $order_date = date("Y/m/d");
              $order_time = date("h:i:sa");
              $is_pickup = "1";
              $stmt = $conn->prepare($insert_query);
              $stmt->bind_param(
                'ssssssssss',
                $product_id,
                $variant_id,
                $user_id,
                $order_date,
                $order_time,
                $product_quantity,
                $is_pickup,
                $user_address,
                $user_phone,
                $customer_email
              );
            }
          }

          $result = $stmt->execute();
          if ($result == 1) {
            unset($_SESSION['errors.type']);
            unset($_SESSION['errors.title']);
            unset($_SESSION['errors.message']);
            $stmt->close();
            $conn->close();
            header('Location: ../pos/');
          } else {
            $_SESSION['errors.type'] = 'add_order_error';
            $_SESSION['errors.title'] = 'Something went wrong';
            $_SESSION['errors.message'] = 'Unable to add to cart, might be missing some required parameters';
            header('Location: ../pos/');
          }
        } else {
          $_SESSION['errors.type'] = 'add_order_error';
          $_SESSION['errors.title'] = 'Something went wrong';
          $_SESSION['errors.message'] = 'Unable to add to cart, might be missing some required parameters';
          header('Location: ../pos/');
        }
      } else {
        $_SESSION['errors.type'] = 'add_order_error';
        $_SESSION['errors.title'] = 'Something went wrong';
        $_SESSION['errors.message'] = 'Unable to add to cart, might be missing some required parameters';
        header('Location: ../pos/');
      }
    } else {
      $_SESSION['errors.type'] = 'add_order_error';
      $_SESSION['errors.title'] = 'Something went wrong';
      $_SESSION['errors.message'] = 'Unable to add to cart, might be missing some required parameters';
      header('Location: ../pos/');
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>
