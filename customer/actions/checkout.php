<?php
  include('../../utils/connections.php');
  session_start();
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
      isset($_POST['checkout_type']) &&
      isset($_POST['product_id']) &&
      isset($_POST['product_quantity']) &&
      isset($_POST['customer_email']) &&
      isset($_POST['category_id']) &&
      isset($_POST['category_name']) &&
      isset($_POST['category_description']) &&
      isset($_POST['select_variant'])
    ) {
      $category_id = intval($_POST['category_id']);
      $category_name = $_POST['category_name'];
      $category_description = $_POST['category_description'];
      $customer_email = $conn->real_escape_string($_POST['customer_email']);
      $checkout_type = $conn->real_escape_string($_POST['checkout_type']);
      $select_variant = $conn->real_escape_string($_POST['select_variant']);
      $product_id = intval($conn->real_escape_string($_POST['product_id']));
      $product_quantity = intval($conn->real_escape_string($_POST['product_quantity']));
      if ($customer_email != "") {
        $fetch_query = "SELECT * FROM user_info WHERE email = '".$customer_email."' LIMIT 1";
        $result = $conn->query($fetch_query);
        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $user_id = intval($row['id']);
          $user_phone = $row['phone'];
          $user_address = $row['address'];

          $parts = explode("-", $select_variant);
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
              $_SESSION['errors.title'] = 'Unable to checkout';
              $_SESSION['errors.message'] = 'Something went wrong, unable to add to cart products. Product must be out of stock or quantity might be greater than the available products.';
              header('Location: ../info/?id='.$product_id.'&category_id='.$category_id."&category_name=".$category_name."&category_description=".$category_description);
              return;
            }
          }

          $fetch_query = "SELECT * FROM products_prices WHERE product_id = ".$variant_product_id." AND variant_id = ".$variant_id." LIMIT 1";
          $result = $conn->query($fetch_query);
          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $variant_id = intval($row['variant_id']);
            $variant_price = $row['variant_price'];
            if ($checkout_type == 'add_to_cart') {
              $fetch_query = "SELECT * FROM cart WHERE product_id = ".$variant_product_id." AND user_email = '".$customer_email."'";
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
            } else {
              $fetch_query = "SELECT * FROM cart WHERE product_id = ".$variant_product_id." AND user_email = '".$customer_email."'";
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
              $fetch_query = "SELECT * FROM cart WHERE user_email = '".$customer_email."'";
              $result = $conn->query($fetch_query);
              $cart_quantity = $result->num_rows;
              unset($_SESSION['errors.type']);
              unset($_SESSION['errors.title']);
              unset($_SESSION['errors.message']);
              if ($checkout_type == 'add_to_cart') {
                $_SESSION['checkout.message'] = "Added to cart successfully!";
                $_SESSION['checkout.quantity'] = $cart_quantity;
                header('Location: ../info/?id='.$product_id.'&category_id='.$category_id."&category_name=".$category_name."&category_description=".$category_description);
              } else {
                unset($_SESSION['checkout.message']);
                unset($_SESSION['checkout.quantity']);
                header('Location: ../cart');
              }
            } else {
              $_SESSION['errors.type'] = 'checkout';
              $_SESSION['errors.title'] = 'Unable to add to cart';
              $_SESSION['errors.message'] = 'Something went wrong, unable to add to cart this product.';
              header('Location: ../info/?id='.$product_id.'&category_id='.$category_id."&category_name=".$category_name."&category_description=".$category_description);
            }
          } else {
            $_SESSION['errors.type'] = 'checkout';
            $_SESSION['errors.title'] = 'Unable to add to cart';
            $_SESSION['errors.message'] = 'Something went wrong, unable to add to cart this product.';
            header('Location: ../info/?id='.$product_id.'&category_id='.$category_id."&category_name=".$category_name."&category_description=".$category_description);
          }
        } else {
          $_SESSION['errors.type'] = 'checkout';
          $_SESSION['errors.title'] = 'Unable to add to cart';
          $_SESSION['errors.message'] = 'Something went wrong, unable to add to cart this product.';
          header('Location: ../info/?id='.$product_id.'&category_id='.$category_id."&category_name=".$category_name."&category_description=".$category_description);
        }
      } else {
        $_SESSION['errors.type'] = 'checkout';
        $_SESSION['errors.title'] = 'Unable to add to cart';
        $_SESSION['errors.message'] = 'Something went wrong, unable to add to cart this product.';
        header('Location: ../info/?id='.$product_id.'&category_id='.$category_id."&category_name=".$category_name."&category_description=".$category_description);
      }
    } else {
      $_SESSION['errors.type'] = 'checkout';
      $_SESSION['errors.title'] = 'Unable to add to cart';
      $_SESSION['errors.message'] = 'Something went wrong, unable to add to cart this product.';
      header('Location: ../../');
    }
  }
?>
