<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['category_id'])) {
        $category_id = $_POST['category_id'];
        $delete_query = "DELETE FROM categories WHERE id = ".$category_id."";
        $delete_product_category_query = "DELETE FROM products_categories WHERE category_id = ".$category_id."";
        $conn->query($delete_query);
        $conn->query($delete_product_category_query);
        header('Location: ../categories/');
      }
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>