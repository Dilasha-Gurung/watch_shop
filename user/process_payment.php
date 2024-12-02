<?php
include("../co.php");

$data = json_decode(file_get_contents("php://input"), true);

// Extract the data from the POST request
$transactionID = $data['orderID'];  // PayPal transaction ID
$userID = $data['userID'];
$items = $data['items'];
$total = $data['total'];
$shippingAddress = mysqli_real_escape_string($conn, $data['shipping_address']);
$paymentMethod = mysqli_real_escape_string($conn, $data['payment_method']);
$paymentStatus = mysqli_real_escape_string($conn, $data['payment_status']);  // 'COMPLETED', 'PENDING', etc.

// Insert the order into the 'orders' table
$order_query = "INSERT INTO orders (ucid, transaction_id, cid, quantity, total_price, status, shipping_address, payment_method, payment_status, shipping_status)
                VALUES ('$userID', '$transactionID', '{$items[0]['id']}', '{$items[0]['quantity']}', '$total', 'Pending', '$shippingAddress', '$paymentMethod', '$paymentStatus', 'Pending')";

$order_result = mysqli_query($conn, $order_query);

if ($order_result) {
    // Get the order ID of the inserted order
    $newOrderID = mysqli_insert_id($conn);

    // Insert each item in the order into the 'order_items' table
    foreach ($items as $item) {
        $productID = $item['id'];
        $quantity = $item['quantity'];
        $price = $item['price'];

        $item_query = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                       VALUES ('$newOrderID', '$productID', '$quantity', '$price')";
        mysqli_query($conn, $item_query);
    }

    // Send success response back to the JavaScript
    echo json_encode(['success' => true, 'order_id' => $newOrderID]);
} else {
    // Send error response if the order could not be inserted
    echo json_encode(['success' => false, 'message' => 'Error placing order.']);
}
?>
