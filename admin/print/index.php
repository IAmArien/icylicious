<?php
  session_start();
  include('../../utils/connections.php');
  if (
    !isset($_SESSION['user_credentials.username']) &&
    !isset($_SESSION['user_credentials.type'])
  ) {
    header('Location: ../');
  } else if (isset($_SESSION['user_credentials.type'])) {
    if ($_SESSION['user_credentials.type'] != "admin") {
      header('Location: ../');
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin / Print Order</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    >
    <link href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/global.css" />
    <link rel="stylesheet" href="./css/print.css" />
  </head>
  <body>
    <div class="container" style="margin-top: 20px;">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12"></div>
        <div class="col-lg-4 col-md-4 col-sm-12" id="div-printable">
          <table class="table">
            <?php
              $receipt_id = "";
              $transaction_id = "";
              $date_time = "";
              $quantity_orders = 0;
              $subtotal = 0.00;
              $vat = 0.00;
              $payment = 0.00;
              $total = 0.00;
              $change = 0.00;

              if (isset($_GET['transaction_id'])) {

                $receipt_id = $conn->real_escape_string($_GET['transaction_id']);
                $transaction_id = $conn->real_escape_string($_GET['transaction_id']);
                $order_id = 0;

                // get sub total
                $fetch_query = "SELECT * FROM orders WHERE transaction_id = '".$transaction_id."' ORDER BY id DESC LIMIT 1";
                $result = $conn->query($fetch_query);
                if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $order_id = $row["id"];
                  $subtotal = floatval($row['order_total']);
                  $order_date = $row['order_date'];
                  $order_time = $row['order_time'];
                  $date_time = $order_date.' '.$order_time;
                }

                // get payment and change
                $fetch_query = "SELECT * FROM orders_billing WHERE order_id = ".$order_id." ORDER BY id DESC LIMIT 1";
                $result = $conn->query($fetch_query);
                if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $payment = floatval($row['payment']);
                  $amount_paid = floatval($row['amount_paid']);
                  $change = $payment - $amount_paid;
                }

                // get quantity
                $fetch_query = "SELECT * FROM orders WHERE transaction_id = '".$transaction_id."' ORDER BY id DESC";
                $result = $conn->query($fetch_query);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $order_quantity = $row['order_quantity'];
                    $quantity_orders += intval($order_quantity);
                  }
                }

                $total = $subtotal - $vat;
              }
            ?>
            <tr>
              <td class="sans-600 color-dark-grey">Icylicious PH Cafe&nbsp;&nbsp;</td>
              <td></td>
            </tr>
            <tr>
              <td class="sans-600 color-dark-grey">Receipt ID:&nbsp;&nbsp;</td>
              <td><?php echo $receipt_id; ?></td>
            </tr>
            <tr>
              <td class="sans-600 color-dark-grey">Date / Time:&nbsp;&nbsp;</td>
              <td><?php echo $date_time; ?></td>
            </tr>
            <tr>
              <td class="sans-600 color-dark-grey">&nbsp;&nbsp;</td>
              <td></td>
            </tr>
            <tr>
              <td class="sans-600 color-dark-grey">Orders&nbsp;&nbsp;</td>
              <td><?php echo $quantity_orders; ?></td>
            </tr>
            <?php
              // get orders
              $fetch_query = "SELECT * FROM orders WHERE transaction_id = '".$transaction_id."' ORDER BY id DESC";
              $result = $conn->query($fetch_query);
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $order_quantity = $row['order_quantity'];
                  $product_name = $row["product_name"];
                  $variant_type = $row['variant_type'];
                  $variant_name = $row['variant_name'];
                  $variant_price = floatval($row['variant_price']);
                  echo '
                    <tr>
                      <td class="sans-600 color-dark-grey">
                        ('.$order_quantity.') '.$product_name.'&nbsp;&nbsp;<br/>'.$variant_type.': '.$variant_name.'&nbsp;&nbsp;
                      </td>
                      <td>₱'.number_format($variant_price).'</td>
                    </tr>
                  ';
                }
              }
            ?>
            <tr>
              <td class="sans-600 color-dark-grey">&nbsp;&nbsp;</td>
              <td></td>
            </tr>
            <tr>
              <td class="sans-600 color-dark-grey">Sub-Total&nbsp;&nbsp;</td>
              <td>₱<?php echo number_format($subtotal); ?></td>
            </tr>
            <tr>
              <td class="sans-600 color-dark-grey">VAT&nbsp;&nbsp;</td>
              <td>₱<?php echo number_format($vat); ?></td>
            </tr>
            <tr>
              <td class="sans-600 color-dark-grey">Total&nbsp;&nbsp;</td>
              <td>₱<?php echo number_format($total); ?></td>
            </tr>
            <tr>
              <td class="sans-600 color-dark-grey">Payment&nbsp;&nbsp;</td>
              <td>₱<?php echo number_format($payment); ?></td>
            </tr>
            <tr>
              <td class="sans-600 color-dark-grey">Change&nbsp;&nbsp;</td>
              <td>₱<?php echo number_format($change); ?></td>
            </tr>
          </table>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12"></div>
      </div>
    </div>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/b2e03e5a6f.js" crossorigin="anonymous"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous">
  </script>
  <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
  <script type="text/javascript">
    $(document).ready(() => {
      setTimeout(() => {
        let printWindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');
        printWindow.document.write(`<html><head><title>Print Receipt</title>`);
        printWindow.document.write('</head><body >');
        printWindow.document.write(document.getElementById('div-printable').innerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
      }, 1000);
    });
  </script>
</html>
