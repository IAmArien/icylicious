<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['variant_id'])) {
        $variant_id = $_POST['variant_id'];
        $delete_query = "DELETE FROM variants WHERE id = ".$variant_id."";
        $conn->query($delete_query);
        header('Location: ../variants/');
      }
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>