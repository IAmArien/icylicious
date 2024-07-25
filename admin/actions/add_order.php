<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (
        isset($_POST['product_id']) &&
        isset($_POST['product_quantity']) &&
        isset($_POST['user_email']) &&
        isset($_POST['selected_variant'])
      ) {
        $product_id = intval($conn->real_escape_string($_POST['product_id']));
        $product_quantity = intval($conn->real_escape_string($_POST['product_quantity']));
        $selected_variant = $conn->real_escape_string($_POST['selected_variant']);
        $customer_email = $conn->real_escape_string($_POST['user_email']);

        if ($product_quantity == 0) {
          $product_quantity = 1;
        }

        $fetch_query = "SELECT * FROM user_info WHERE email = '".$customer_email."' LIMIT 1";
        $result = $conn->query($fetch_query);
        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $user_id = intval($row['id']);
          $user_phone = $row['phone'];
          $user_address = $row['address'];

          $parts = explode("-", $selected_variant);
          $variant_product_id = intval($parts[0]);
          $variant_id = intval($parts[1]);

          $fetch_query = "SELECT * FROM products_inventory WHERE product_id = ".$variant_product_id." LIMIT 1";
          $inventory_result = $conn->query($fetch_query);
          if ($inventory_result->num_rows > 0) {
            $inventory_row = $inventory_result->fetch_assoc();
            $stocks = intval($inventory_row['stocks']);
            $restock_level_point = intval($inventory_row['restock_level_point']);
            if ($product_quantity > $stocks) {
              $_SESSION['errors.type'] = 'checkout';
              $_SESSION['errors.title'] = 'Unable to add to cart';
              $_SESSION['errors.message'] = 'Something went wrong, unable to add to cart products. Product must be out of stock or quantity might be greater than the available products.';
              header('Location: ../pos/');
              return;
            }
          }

          $fetch_query = "SELECT * FROM products_prices WHERE product_id = ".$variant_product_id." AND variant_id = ".$variant_id." LIMIT 1";
          $result = $conn->query($fetch_query);
          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $variant_id = intval($row['variant_id']);
            $variant_price = $row['variant_price'];

            $fetch_query = "SELECT * FROM cart WHERE product_id = ".$variant_product_id." AND variant_id = ".$variant_id." AND user_email = '".$customer_email."'";
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
                $variant_product_id,
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
            // Update Logs
            $activity = "Add Order";
            $activity_date = date("Y/m/d");
            $activity_time = date("h:i:sa");
            $user_email = $_SESSION['user_info.email'];
            $user_fullname = $_SESSION['user_info.first_name'].' '.$_SESSION['user_info.last_name'];
            $insert_query = "INSERT INTO activity_log (
                activity,
                activity_date,
                activity_time,
                user_email,
                user_fullname
              ) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param(
              'sssss',
              $activity,
              $activity_date,
              $activity_time,
              $user_email,
              $user_fullname
            );
            $result = $stmt->execute();
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
