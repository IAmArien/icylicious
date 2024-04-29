<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['category']) && isset($_POST['description'])) {
        $category = $conn->real_escape_string($_POST['category']);
        $description = $conn->real_escape_string($_POST['description']);
        $insert_query = "INSERT INTO categories (category_name, category_description) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param('ss', $category, $description);
        $result = $stmt->execute();
        if ($result == 1) {
          unset($_SESSION['errors.type']);
          unset($_SESSION['errors.title']);
          unset($_SESSION['errors.message']);
          $stmt->close();
          $conn->close();
          header('Location: ../categories/');
        } else {
          $_SESSION['errors.type'] = 'category_error';
          $_SESSION['errors.title'] = 'Something went wrong';
          $_SESSION['errors.message'] = 'Unable to add new category, might be missing some required parameters';
          header('Location: ../categories/');
        }
      } else {
        $_SESSION['errors.type'] = 'category_error';
        $_SESSION['errors.title'] = 'Something went wrong';
        $_SESSION['errors.message'] = 'Unable to add new category, might be missing some required parameters';
        header('Location: ../categories/');
      }
    } else {
      $_SESSION['errors.type'] = 'category_error';
      $_SESSION['errors.title'] = 'Something went wrong';
      $_SESSION['errors.message'] = 'Unable to add new category, might be missing some required parameters';
      header('Location: ../categories/');
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>
