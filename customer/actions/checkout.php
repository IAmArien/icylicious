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
      isset($_POST['category_description'])
    ) {
      $category_id = intval($_POST['category_id']);
      $category_name = $_POST['category_name'];
      $category_description = $_POST['category_description'];
      $customer_email = $conn->real_escape_string($_POST['customer_email']);
      $checkout_type = $conn->real_escape_string($_POST['checkout_type']);
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
          $fetch_query = "SELECT * FROM products_prices WHERE product_id = ".$product_id."";
          $result = $conn->query($fetch_query);
          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $variant_id = intval($row['variant_id']);
            $variant_price = $row['variant_price'];
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
