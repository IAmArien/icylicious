<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        $delete_product_info_query = "DELETE FROM products_info WHERE id = ".$product_id."";
        $delete_product_cat_query = "DELETE FROM products_categories WHERE product_id = ".$product_id."";
        $delete_product_img_query = "DELETE FROM products_images WHERE product_id = ".$product_id."";
        $delete_product_price_query = "DELETE FROM products_prices WHERE product_id = ".$product_id."";
        $delete_promotions_query = "DELETE FROM promotions WHERE product_id = ".$product_id."";
        $delete_best_sellers_query = "DELETE FROM best_sellers WHERE product_id = ".$product_id."";
        $delete_cart_items_query = "DELETE FROM cart WHERE product_id = ".$product_id."";
        $conn->query($delete_product_info_query);
        $conn->query($delete_product_cat_query);
        $conn->query($delete_product_img_query);
        $conn->query($delete_product_price_query);
        $conn->query($delete_promotions_query);
        $conn->query($delete_best_sellers_query);
        $conn->query($delete_cart_items_query);
        // Update Logs
        $activity = "Delete Product";
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
        header('Location: ../products/');
      }
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>