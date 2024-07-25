<?php
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Headers: *');
  header('Access-Control-Allow-Credentials: true');
  header('Access-Control-Max-Age: 86400');
  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="icylicious-filtered_orders.csv"');
  include('../../utils/connections.php');
  session_start();
  try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
        $param_start_date = $conn->real_escape_string($_POST['start_date']);
        $param_end_date = $conn->real_escape_string($_POST['end_date']);
        $start_date = date('Y-m-d', strtotime($param_start_date));
        $end_date = date('Y-m-d', strtotime($param_end_date));

        // Update Logs
        $activity = "Exported Products";
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
        $stmt->execute();
        unset($_SESSION['errors.type']);
        unset($_SESSION['errors.title']);
        unset($_SESSION['errors.message']);

        $fetch_query = "SELECT * FROM products_info ORDER BY id DESC";
        $products_result = $conn->query($fetch_query);

        $fp = fopen('php://output', 'wb');
        $concat = "ORDER_ID,RECEIPT_ID,PRODUCT_NAME,PRODUCT_STOCK,PRODUCT_RESTOCK_POINT,VARIANT_TYPE,VARIANT_NAME,PRICE,ORDER_DATE,ORDER_TIME,QUANTITY,STATUS,ORDER_TYPE,TOTAL,CUSTOMER,EMAIL,PHONE,ADDRESS";
        $val = explode(",", $concat);
        fputcsv($fp, $val);

        if ($products_result->num_rows > 0) {
          while ($products_row = $products_result->fetch_assoc()) {
            $product_row_id = $products_row['id'];
            $fetch_query = "SELECT * FROM orders WHERE order_date >= '".$start_date."' AND order_date <= '".$end_date."' AND product_id = ".$product_row_id."";
            $result = $conn->query($fetch_query);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $order_id = $row["id"];
                $transaction_id = $row["transaction_id"];
                $product_id = $row["product_id"];
                $product_name = $row["product_name"];
                $product_stocks = $row['product_stock'];
                $product_restock_level_point = $row['product_restock_level_point'];
                $variant_type = $row['variant_type'];
                $variant_name = $row['variant_name'];
                $variant_price = $row['variant_price'];
                $order_date = $row['order_date'];
                $order_time = $row['order_time'];
                $order_quantity = $row['order_quantity'];
                $order_status = $row['order_status'];
                $order_type = $row['order_type'];
                $order_total = floatval($row['order_total']);
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $customer_name = $user_firstname." ".$user_lastname;
                $user_email = $row['user_email'];
                $user_phone = $row['user_phone'];
                $user_address = $row['user_address'];
                $concat = $order_id.",".$transaction_id.",".$product_name.",".$product_stocks.",".$product_restock_level_point.",".$variant_type.",".$variant_name.",".$variant_price.",".$order_date.",".$order_time.",".$order_quantity.",".$order_status.",".$order_type.",".$order_total.",".$customer_name.",".$user_email.",".$user_phone.",".$user_address;
                $val = explode(",", $concat);
                fputcsv($fp, $val);
              }
            }
          }
        }

        fclose($fp);
      } else {
        $_SESSION['errors.type'] = 'export_error';
        $_SESSION['errors.title'] = 'Something went wrong';
        $_SESSION['errors.message'] = 'Unable to export to CSV, might be missing some required parameters';
        header('Location: ../products/');
      }
    } else {
      $_SESSION['errors.type'] = 'export_error';
      $_SESSION['errors.title'] = 'Something went wrong';
      $_SESSION['errors.message'] = 'Unable to export to CSV, might be missing some required parameters';
      header('Location: ../products/');
    }
  } catch (\Throwable $th) {
    echo $th;
  }
?>
