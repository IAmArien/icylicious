<?php
  include('../../utils/connections.php');
  header('Content-Type: application/json; charset=utf-8');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_FILES["product_image_1"])) {
        $target_dir = "../uploads/";
        $file_name = basename($_FILES["product_image_1"]["name"]);
        $temp_path = $target_dir.$file_name;
        $file_type = strtolower(pathinfo($temp_path, PATHINFO_EXTENSION));
        $new_file_name = md5($file_name)."-".rand(0, 500).'.'.$file_type;
        $target_file = $target_dir.$new_file_name;
        $file_exists = file_exists($target_file);
        if ($file_exists) {
          $response = [
            'status' => 422,
            'message' => 'File already exists'
          ];
          echo json_encode($response);
        } else {
          $uploaded = move_uploaded_file(
            $_FILES['product_image_1']['tmp_name'],
            $target_file
          );
          $response = [
            'status' => 201,
            'message' => 'File upload successful',
            'file' => $target_file
          ];
          echo json_encode($response);
        }
        unset($_SESSION['errors.type']);
        unset($_SESSION['errors.title']);
        unset($_SESSION['errors.message']);
      }
      if (isset($_FILES["product_image_2"])) {
        $target_dir = "../uploads/";
        $file_name = basename($_FILES["product_image_2"]["name"]);
        $temp_path = $target_dir.$file_name;
        $file_type = strtolower(pathinfo($temp_path, PATHINFO_EXTENSION));
        $new_file_name = md5($file_name)."-".rand(0, 500).'.'.$file_type;
        $target_file = $target_dir.$new_file_name;
        $file_exists = file_exists($target_file);
        if ($file_exists) {
          $response = [
            'status' => 422,
            'message' => 'File already exists'
          ];
          echo json_encode($response);
        } else {
          $uploaded = move_uploaded_file(
            $_FILES['product_image_2']['tmp_name'],
            $target_file
          );
          $response = [
            'status' => 201,
            'message' => 'File upload successful',
            'file' => $target_file
          ];
          echo json_encode($response);
        }
        unset($_SESSION['errors.type']);
        unset($_SESSION['errors.title']);
        unset($_SESSION['errors.message']);
      }
      if (isset($_FILES["product_image_3"])) {
        $target_dir = "../uploads/";
        $file_name = basename($_FILES["product_image_3"]["name"]);
        $temp_path = $target_dir.$file_name;
        $file_type = strtolower(pathinfo($temp_path, PATHINFO_EXTENSION));
        $new_file_name = md5($file_name)."-".rand(0, 500).'.'.$file_type;
        $target_file = $target_dir.$new_file_name;
        $file_exists = file_exists($target_file);
        if ($file_exists) {
          $response = [
            'status' => 422,
            'message' => 'File already exists'
          ];
          echo json_encode($response);
        } else {
          $uploaded = move_uploaded_file(
            $_FILES['product_image_3']['tmp_name'],
            $target_file
          );
          $response = [
            'status' => 201,
            'message' => 'File upload successful',
            'file' => $target_file
          ];
          echo json_encode($response);
        }
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
