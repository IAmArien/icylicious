<?php
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (
        isset($_POST['category_id']) &&
        isset($_POST['category']) &&
        isset($_POST['description'])
      ) {
        $category_id = $conn->real_escape_string($_POST['category_id']);
        $category = $conn->real_escape_string($_POST['category']);
        $description = $conn->real_escape_string($_POST['description']);
        $update_query = "UPDATE categories SET category_name = ?, category_description = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('sss', $category, $description, $category_id);
        $result = $stmt->execute();
        if ($result == 1) {
          // Update Logs
          $activity = "Update Category";
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
          header('Location: ../categories/');
        } else {
          $_SESSION['errors.type'] = 'category_error';
          $_SESSION['errors.title'] = 'Something went wrong';
          $_SESSION['errors.message'] = 'Unable to update category, might be missing some required parameters';
          header('Location: ../categories/');
        }
      } else {
        $_SESSION['errors.type'] = 'category_error';
        $_SESSION['errors.title'] = 'Something went wrong';
        $_SESSION['errors.message'] = 'Unable to update category, might be missing some required parameters';
        header('Location: ../categories/');
      }
    } else {
      $_SESSION['errors.type'] = 'category_error';
      $_SESSION['errors.title'] = 'Something went wrong';
      $_SESSION['errors.message'] = 'Unable to update category, might be missing some required parameters';
      header('Location: ../categories/');
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>
