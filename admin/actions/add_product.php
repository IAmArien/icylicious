<?php
  include('../../utils/connections.php');
  header('Content-Type: application/json; charset=utf-8');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $target_dir = "../uploads/images/";
      $target_file = $target_dir . basename($_FILES["product_image_1"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $response = [
        'imageFileType' => $imageFileType,
        'targetFile' => $target_file,
        'name' => $$_FILES['product_image_1']
      ]
      echo json_encode($response);
    } else {
      $_SESSION['errors.type'] = 'product_error';
      $_SESSION['errors.title'] = 'Something went wrong';
      $_SESSION['errors.message'] = 'Unable to add new category, might be missing some required parameters';
      header('Location: ../products/');
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>
