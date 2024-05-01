<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['ed-product_id'])) {
        $product_id = $conn->real_escape_string($_POST['ed-product_id']);
        echo $product_id;

        // update product info
        if (
          isset($_POST['ed-product_name']) &&
          isset($_POST['ed-product_description'])
        ) {
          $product_name = $conn->real_escape_string($_POST['ed-product_name']);
          $product_description = $conn->real_escape_string($_POST['ed-product_description']);
          $update_query = "UPDATE products_info SET 
            product_name = ?,
            product_description = ?
            WHERE id = ?";
          $stmt = $conn->prepare($update_query);
          $stmt->bind_param('sss', $product_name, $product_description, $product_id);
          $result = $stmt->execute();
        }

        // update product categories
        if (isset($_POST['ed-product_category'])) {
          $product_category = intval($conn->real_escape_string($_POST['ed-product_category']));
          $update_query = "UPDATE products_categories SET 
            category_id = ? 
            WHERE product_id = ?";
          $stmt = $conn->prepare($update_query);
          $stmt->bind_param('ss', $product_category, $product_id);
          $result = $stmt->execute();
        }

        // update product variants and prices
        if (
          isset($_POST['ed-product_variants']) &&
          isset($_POST['ed-product_price'])
        ) {
          $product_variants = intval($conn->real_escape_string($_POST['ed-product_variants']));
          $product_price = intval($conn->real_escape_string($_POST['ed-product_price']));
          $update_query = "UPDATE products_prices SET 
            variant_id = ?,
            variant_price = ? 
            WHERE product_id = ?";
          $stmt = $conn->prepare($update_query);
          $stmt->bind_param('sss', $product_variants, $product_price, $product_id);
          $result = $stmt->execute();
        }

        // update promotions if there's any
        if (
          isset($_POST['ed-promotion']) &&
          isset($_POST['ed-promotion_price']) &&
          isset($_POST['ed-buy_x']) &&
          isset($_POST['ed-take_x'])
        ) {
          $promotion_type = $conn->real_escape_string($_POST['ed-promotion']);
          $promotion_price = intval($conn->real_escape_string($_POST['ed-promotion_price']));
          $promotion_buy_x = intval($conn->real_escape_string($_POST['ed-buy_x']));
          $promotion_take_x = intval($conn->real_escape_string($_POST['ed-take_x']));
          $delete_query = "DELETE FROM promotions WHERE product_id = ".$product_id."";
          $result = $conn->query($delete_query);
          // insert promotions if there's any
          if ($promotion_type == 'discounted') {
            $ptype = 0;
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
          } else if ($promotion_type == 'buy_x_take_x') {
            $ptype = 1;
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
        }

        // update product images
        $delete_query = "DELETE FROM products_images WHERE product_id = ".$product_id."";
        $result = $conn->query($delete_query);
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
      } else {
        $_SESSION['errors.type'] = 'product_error';
        $_SESSION['errors.title'] = 'Something went wrong';
        $_SESSION['errors.message'] = 'Unable to update product, might be missing some required parameters';
        header('Location: ../products/');
      }
    } else {
      $_SESSION['errors.type'] = 'product_error';
      $_SESSION['errors.title'] = 'Something went wrong';
      $_SESSION['errors.message'] = 'Unable to update product, might be missing some required parameters';
      header('Location: ../products/');
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>
