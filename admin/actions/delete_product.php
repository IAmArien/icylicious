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
        $conn->query($delete_product_info_query);
        $conn->query($delete_product_cat_query);
        $conn->query($delete_product_img_query);
        $conn->query($delete_product_price_query);
        $conn->query($delete_promotions_query);
        $conn->query($delete_best_sellers_query);
        header('Location: ../products/');
      }
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>