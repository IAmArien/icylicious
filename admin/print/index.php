<?php
if (isset($_GET['transaction_id'])) {
    $transaction_id = $_GET['transaction_id'];

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "icylicious_ordering_system";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch transaction details
    $sql = "SELECT * FROM orders WHERE transaction_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $transaction_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Assume all items are fetched for the given transaction_id
        $transaction_details = [
            'transaction_id' => $transaction_id,
            'date' => '',
            'customer_name' => '',
            'items' => [],
            'total' => 0
        ];

        while ($row = $result->fetch_assoc()) {
            if (empty($transaction_details['date'])) {
                $transaction_details['date'] = $row['order_date'];
            }
            if (empty($transaction_details['time'])) {
              $transaction_details['time'] = $row['order_time'];
          }
            if (empty($transaction_details['customer_name'])) {
                $transaction_details['customer_name'] = $row['user_firstname'] . ' ' . $row['user_lastname'];
            }
            $transaction_details['items'][] = [
                'name' => $row['product_name'],
                'quantity' => $row['order_quantity'],
                'price' => $row['variant_price']
            ];
            $transaction_details['total'] += $row['order_quantity'] * $row['variant_price'];
        }
    } else {
        echo 'No transaction found for the given ID.';
        exit;
    }

    $stmt->close();
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt</title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; }
        .receipt { width: 80mm; margin: auto; padding: 10px; border: 1px solid #000; }
        .receipt .logo { text-align: center; margin-bottom: 10px; }
        .receipt .logo img { width: 15mm; height: auto; }
        .receipt h2 { text-align: center; font-size: 28px; margin: 0; }
        .receipt h1 { text-align: center; font-size: 16px; margin: 0; }
        .receipt .details { margin-bottom: 20px; font-size: 14px; }
        .receipt .details p { margin: 5px 0; }
        .receipt .items { width: 100%; border-collapse: collapse; font-size: 14px; }
        .receipt .items th, .receipt .items td { border: 1px solid #000; padding: 5px; }
        .receipt .total { text-align: right; font-size: 16px; margin-top: 20px; }
        .receipt .footer { margin-top: 20px; font-size: 12px; text-align: center; }

        @media print {
            @page {
                size: 80mm auto;
                margin: 0;
            }
            body {
                zoom: 1.5; /* Scale to 200% */
            }
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="receipt">
    <div class="logo">
            <img src="../uploads/icy.png" alt="Company Logo">
        </div>
        <h2>ICYLICIOUS&trade;</h2>
        <h1>Order Receipt</h1>
        <div class="details">
            <p>Transaction ID: <?php echo htmlspecialchars($transaction_details['transaction_id']); ?></p>
            <p>Date & Time: <?php echo htmlspecialchars($transaction_details['date'] . ' ' . $transaction_details['time']); ?></p>
            <p>Input By: <?php echo htmlspecialchars($transaction_details['customer_name']); ?></p>
        </div>
        <table class="items">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transaction_details['items'] as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td><?php echo htmlspecialchars(number_format($item['price'], 2)); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="total">
            <p>Total: ₱<?php echo htmlspecialchars(number_format($transaction_details['total'], 2)); ?></p>
        </div>
        <div class="footer">
            <p>Thank you for your purchase!</p>
            <p>We appreciate your business and look forward to serving you again.</p>
        </div>
    </div>
    
</body>
</html>
<?php
} else {
    echo 'Transaction ID is missing.';
}
?>