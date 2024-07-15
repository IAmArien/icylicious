<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['category_id'])) {
        $category_id = $_POST['category_id'];
        $delete_query = "DELETE FROM categories WHERE id = ".$category_id."";
        $delete_product_category_query = "DELETE FROM products_categories WHERE category_id = ".$category_id."";
        // Update Logs
        $activity = "Delete Category";
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
        $conn->query($delete_query);
        $conn->query($delete_product_category_query);
        header('Location: ../categories/');
      }
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>