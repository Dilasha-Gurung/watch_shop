<?php
session_start();
include("../co.php");
if (isset($_GET['id'])) {  
    $id = $_GET['id']; 
    $uid = $_SESSION["id"]; 
    $sq = "DELETE FROM cart WHERE cid=$id AND ucid=$uid";
    $qry = mysqli_query($conn, $sq);
} 

$uid = $_SESSION["id"];
$sql = "SELECT w.id, w.name, w.photo, w.price, w.description, c.quantity FROM watch AS w JOIN cart AS c ON w.id=c.cid WHERE c.ucid=$uid;";
$qry = mysqli_query($conn, $sql) or die(mysqli_error($conn));

$count = mysqli_num_rows($qry);
$grand_total = 0;
$cart_items = [];

if ($count >= 1) {
    while ($row = mysqli_fetch_array($qry)) {
        $item_total = $row['price'] * $row['quantity'];
        $grand_total += $item_total;
        $cart_items[] = [
            'name' => $row['name'],
            'quantity' => $row['quantity'],
            'price' => $row['price'],
            'photo' => $row['photo'],
            'description' => $row['description'],
            'id' => $row['id']
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AWZdTWdVOGLcQN14XRZs2PQT2-dOcH1S2J0xqbSL_zUvkDFyPcysThKlx7Tg5GiMK6dxpu9763Zz4iwA&currency=USD"></script>
    <style>
        p {
            font-size: 3rem;
            margin-right: 20px;
        }
    </style>
</head>
<body>
<?php include("headeruser.php"); ?>

<div class="container-xl">
    <table class="table caption-top table-hover">
        <caption><b>List of Watches</b></caption>
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Picture</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Description</th>
                <th scope="col">Remove Watch</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if ($count >= 1) {
                foreach ($cart_items as $item) {
                    echo "<tr>";
                    echo "<td>".$item['name']."</td>";
                    echo "<td><img src=../uploads/img/".$item['photo']." style=width:100px;height:100px></td>";
                    echo "<td>".$item['quantity']."</td>";
                    echo "<td>$ ".$item['price']."</td>";
                    echo "<td>".$item['description']."</td>";
                    echo "<td><a href='cart.php?id=" . $item['id'] . "'><img src='../img/nofav.png' alt='fav' style='width:20px;height:20px;'></a></td>";
                    echo "</tr>";
                }
                echo "<tr>";
                echo "<td colspan=5 style='text-align:right;'>Grand Total</td>";
                echo "<td style='text-align:right;'>$ ".$grand_total."</td>";
                echo "</tr>";
            } else {
                echo "<h1>Your Cart is Empty</h1>";
            }
        ?>
        </tbody>
    </table>

   
     <!-- PayPal Button (Initially hidden) -->
     <div id="paypal-button-container"></div>

<!-- Checkout Button -->
<button class="checkout-btn" id="checkout-btn">Checkout</button>
    <script>
        // // PayPal Button Configuration
        // paypal.Buttons({
        //     createOrder: function(data, actions) {
        //         return actions.order.create({
        //             purchase_units: [{
        //                 amount: {
        //                     value: "<?php echo $grand_total; ?>", // Grand Total
        //                     currency_code: "USD"
        //                 },
        //                 description: "Order of Watches from Your Cart",
        //                 items: <?php echo json_encode($cart_items); ?>  // Send cart items to PayPal
        //             }]
        //         });
        //     },
        //     onApprove: function(data, actions) {
        //         return actions.order.capture().then(function(details) {
        //             alert("Payment Successful! Order ID: " + details.id);
        //             // Optionally, you can send order data to your server for processing
        //             // Example: Send to PHP for order creation in your database
        //         });
        //     },
        //     onError: function(err) {
        //         alert("An error occurred: " + err);
        //     }
        // }).render('#paypal-button-container'); // Render PayPal button in this div


    paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: "<?php echo $grand_total; ?>", // Grand total
                    currency_code: "USD",
                    breakdown: {
                        item_total: {
                            value: "<?php echo $grand_total; ?>",
                            currency_code: "USD"
                        }
                    }
                },
                items: <?php
                    echo json_encode(array_map(function($item) {
                        return [
                            'name' => $item['name'],
                            'quantity' => $item['quantity'],
                            'unit_amount' => [
                                'value' => $item['price'],
                                'currency_code' => "USD"
                            ],
                            'description' => $item['description']
                        ];
                    }, $cart_items));
                ?>
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            alert("Payment Successful! Order ID: " + details.id);
            
            const shippingAddress = details.purchase_units[0].shipping.address;

// Prepare the shipping address as a formatted string
const formattedAddress = `
    ${shippingAddress.address_line_1 || ''},
    ${shippingAddress.address_line_2 || ''},
    ${shippingAddress.admin_area_2 || ''},
    ${shippingAddress.admin_area_1 || ''},
    ${shippingAddress.postal_code || ''},
    ${shippingAddress.country_code || ''}
`.replace(/,\s*,|^\s*,|,\s*$/g, ''); // Clean up empty fiel


            // Send order details to server for database insertion
            fetch('process_payment.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    orderID: details.id,
                    userID: "<?php echo $uid; ?>",
                    items: <?php echo json_encode($cart_items); ?>,
                    total: "<?php echo $grand_total; ?>",
                    shipping_address: formattedAddress, // Include shipping address
                    payment_method: 'PayPal',
                    payment_status: details.status // 'COMPLETED', 'PENDING', etc.
                })
            })
            .then(response => response.json())
            .then(data => {
                // Handle server response
                if (data.success) {
                    alert('Order placed successfully!');
                    // Optionally redirect to order confirmation page
                    window.location.href = "order_confirmation.php?order_id=" + data.order_id;
                } else {
                    alert('Error placing the order.');
                }
            })
            .catch(err => {
                console.error('Error sending order to server:', err);
            });
        });
    },
    onError: function(err) {
        alert("An error occurred: " + err);
    }
}).render('#paypal-button-container');

    </script>
   
    </div>
</div>
</body>
</html>
