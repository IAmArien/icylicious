<?php
  include('../../utils/connections.php');
  header('Content-Type: application/json; charset=utf-8');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $promotion_type = 'none';
      $promotion_price = '0';
      $promotion_buy_x = '0';
      $promotion_take_x = '0';
      if (isset($_POST['promotion'])) {
        $promotion_type = $conn->real_escape_string($_POST['promotion']);
      }
      if (isset($_POST['promotion_price'])) {
        $promotion_price = $conn->real_escape_string($_POST['promotion_price']);
      }
      if (isset($_POST['buy_x'])) {
        $promotion_buy_x = $conn->real_escape_string($_POST['buy_x']);
      }
      if (isset($_POST['take_x'])) {
        $promotion_take_x = $conn->real_escape_string($_POST['take_x']);
      }
      if (
        isset($_POST['product_name']) &&
        isset($_POST['product_description']) &&
        isset($_POST['product_category']) &&
        isset($_POST['product_variants']) &&
        isset($_POST['product_price'])
      ) {
        $product_name = $conn->real_escape_string($_POST['product_name']);
        $product_description = $conn->real_escape_string($_POST['product_description']);
        $product_category = $conn->real_escape_string($_POST['product_category']);
        $product_variants = $conn->real_escape_string($_POST['product_variants']);
        $product_price = $conn->real_escape_string($_POST['product_price']);

        // insert product info
        $insert_query = "INSERT INTO products_info (
          product_name,
          product_description
        ) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param('ss', $product_name, $product_description);
        $result = $stmt->execute();

        // get the inserted product info
        $fetch_query = "SELECT id FROM products_info ORDER BY id DESC LIMIT 1";
        $result = $conn->query($fetch_query);
        $row = $result->fetch_assoc();
        $product_id = $row['id'];

        // insert categories
        $insert_query = "INSERT INTO products_categories (category_id, product_id) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param('ss', $product_category, $product_id);
        $result = $stmt->execute();

        // insert product prices per variants
        $insert_query = "INSERT INTO products_prices (product_id, variant_id, variant_price) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param('sss', $product_id, $product_variants, $product_price);
        $result = $stmt->execute();

        // insert promotions if there's any
        if ($promotion_type == 'discounted') {
          $ptype = '0';
          $insert_query = "INSERT INTO promotions (product_id, promotional_price, is_buy_x_take_x) VALUES (?, ?, ?)";
          $stmt = $conn->prepare($insert_query);
          $stmt->bind_param('sss', $product_id, $promotion_price, $ptype);
          $result = $stmt->execute();
        } else if ($promotion_type == 'buy_x_take_x') {
          $ptype = '1';
          $insert_query = "INSERT INTO promotions (
            product_id,
            promotional_price,
            is_buy_x_take_x,
            buy_x_of,
            take_x_of
          ) VALUES (?, ?, ?, ?, ?)";
          $stmt = $conn->prepare($insert_query);
          $stmt->bind_param('sssss', $product_id, $promotion_price, $ptype, $promotion_buy_x, $promotion_take_x);
          $result = $stmt->execute();
        }

        // insert product images
        if (isset($_POST['first_product_image'])) {
          $image = $_POST['first_product_image'];
          if ($image != '') {
            $insert_query = "INSERT INTO products_images (product_id, product_image) VALUES (?, ?)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param('ss', $product_id, $image);
            $result = $stmt->execute();
          }
        }
        if (isset($_POST['second_product_image'])) {
          $image = $_POST['second_product_image'];
          if ($image != '') {
            $insert_query = "INSERT INTO products_images (product_id, product_image) VALUES (?, ?)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param('ss', $product_id, $image);
            $result = $stmt->execute();
          }
        }
        if (isset($_POST['third_product_image'])) {
          $image = $_POST['third_product_image'];
          if ($image != '') {
            $insert_query = "INSERT INTO products_images (product_id, product_image) VALUES (?, ?)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param('ss', $product_id, $image);
            $result = $stmt->execute();
          }
        }
        unset($_SESSION['errors.type']);
        unset($_SESSION['errors.title']);
        unset($_SESSION['errors.message']);
        $stmt->close();
        $conn->close();
        header('Location: ../products/');
      }
    } else {
      $_SESSION['errors.type'] = 'product_error';
      $_SESSION['errors.title'] = 'Something went wrong';
      $_SESSION['errors.message'] = 'Unable to add new product, might be missing some required parameters';
      header('Location: ../products/');
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>
