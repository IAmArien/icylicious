<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (
        isset($_POST['product_id']) &&
        isset($_POST['product_stocks']) &&
        isset($_POST['product_restocks'])
      ) {
        $stock_product_id = intval($conn->real_escape_string($_POST['product_id']));
        $product_stocks = intval($conn->real_escape_string($_POST['product_stocks']));
        $product_restocks = intval($conn->real_escape_string($_POST['product_restocks']));

        $fetch_query = "SELECT * FROM products_inventory WHERE product_id = ".$stock_product_id."";
        if ($conn->query($fetch_query)->num_rows > 0) {
          $update_query = "UPDATE products_inventory SET stocks = ?, restock_level_point = ? WHERE product_id = ?";
          $stmt = $conn->prepare($update_query);
          $stmt->bind_param('sss', $product_stocks, $product_restocks, $stock_product_id);
        } else {
          $insert_query = "INSERT INTO products_inventory (product_id, stocks, restock_level_point) VALUES (?, ?, ?)";
          $stmt = $conn->prepare($insert_query);
          $stmt->bind_param('sss', $stock_product_id, $product_stocks, $product_restocks);
        }

        $result = $stmt->execute();
        if ($result == 1) {
          // Update Logs
          $activity = "Add / Update Stocks";
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
          header('Location: ../products/');
        } else {
          $_SESSION['errors.type'] = 'products_error';
          $_SESSION['errors.title'] = 'Something went wrong';
          $_SESSION['errors.message'] = 'Unable to add stocks, might be missing some required parameters';
          header('Location: ../products/');
        }
      } else {
        $_SESSION['errors.type'] = 'products_error';
        $_SESSION['errors.title'] = 'Something went wrong';
        $_SESSION['errors.message'] = 'Unable to add stocks, might be missing some required parameters';
        header('Location: ../products/');
      }
    } else {
      $_SESSION['errors.type'] = 'products_error';
      $_SESSION['errors.title'] = 'Something went wrong';
      $_SESSION['errors.message'] = 'Unable to add stocks, might be missing some required parameters';
      header('Location: ../products/');
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>
