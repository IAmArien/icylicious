<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (
        isset($_POST['cart_id']) &&
        isset($_POST['product_quantity']) &&
        isset($_POST['product_id'])
      ) {
        $cart_id = intval($conn->real_escape_string($_POST['cart_id']));
        $product_quantity = $conn->real_escape_string($_POST['product_quantity']);
        $product_id = intval($conn->real_escape_string($_POST['product_id']));

        $fetch_query = "SELECT * FROM products_inventory WHERE product_id = ".$product_id." LIMIT 1";
        $inventory_result = $conn->query($fetch_query);
        if ($inventory_result->num_rows > 0) {
          $inventory_row = $inventory_result->fetch_assoc();
          $stocks = intval($inventory_row['stocks']);
          $restock_level_point = intval($inventory_row['restock_level_point']);
          if ($product_quantity > $stocks) {
            $_SESSION['errors.type'] = 'checkout';
            $_SESSION['errors.title'] = 'Unable to update cart';
            $_SESSION['errors.message'] = 'Something went wrong, unable to update cart products. Product must be out of stock or quantity might be greater than the available products.';
            header('Location: ../cart/');
            return;
          }
        }

        $update_query = "UPDATE cart SET order_quantity = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('ss', $product_quantity, $cart_id);
        $result = $stmt->execute();
        unset($_SESSION['errors.type']);
        unset($_SESSION['errors.title']);
        unset($_SESSION['errors.message']);
        $stmt->close();
        $conn->close();
        header('Location: ../cart/');
      } else {
        $_SESSION['errors.type'] = 'category_error';
        $_SESSION['errors.title'] = 'Something went wrong';
        $_SESSION['errors.message'] = 'Unable to update cart, might be missing some required parameters';
        header('Location: ../cart/');
      }
    } else {
      $_SESSION['errors.type'] = 'category_error';
      $_SESSION['errors.title'] = 'Something went wrong';
      $_SESSION['errors.message'] = 'Unable to update cart, might be missing some required parameters';
      header('Location: ../cart/');
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>
