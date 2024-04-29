<?php
  include('../../utils/connections.php');
  header('Content-Type: application/json; charset=utf-8');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_FILES["product_image_1"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir.basename($_FILES["product_image_1"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $file_exists = file_exists($target_file);
        $uploaded = move_uploaded_file(
          $_FILES['product_image_1']['tmp_name'],
          $target_file
        );
        $response = [
          'fileExists' => $file_exists,
          'uploaded' => $uploaded,
          'imageFileType' => $imageFileType,
          'targetFile' => $target_file,
          'name' => $_FILES['product_image_1']
        ];
        echo json_encode($response);
        unset($_SESSION['errors.type']);
        unset($_SESSION['errors.title']);
        unset($_SESSION['errors.message']);
      }
      if (isset($_FILES["product_image_2"])) {
        unset($_SESSION['errors.type']);
        unset($_SESSION['errors.title']);
        unset($_SESSION['errors.message']);
      }
      if (isset($_FILES["product_image_3"])) {
        unset($_SESSION['errors.type']);
        unset($_SESSION['errors.title']);
        unset($_SESSION['errors.message']);
      }
    } else {
      $_SESSION['errors.type'] = 'product_error';
      $_SESSION['errors.title'] = 'Something went wrong';
      $_SESSION['errors.message'] = '';
      header('Location: ../products/');
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>
