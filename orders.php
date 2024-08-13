<?php include 'header.php'; ?>
<?php include 'db.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO orders (product_id, quantity) VALUES ($product_id, $quantity)";
    if ($conn->query($sql) === TRUE) {
        $success_message = "Order placed successfully";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}

$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
?>

<main>
    <section>
        <h2>Place New Order</h2>
        <?php if (isset($success_message)) { ?>
            <div class="alert success"><?php echo $success_message; ?></div>
        <?php } ?>
        <?php if (isset($error_message)) { ?>
            <div class="alert error"><?php echo $error_message; ?></div>
        <?php } ?>
        <form action="orders.php" method="POST">
            <div class="form-group">
                <label for="product_id">Product ID</label>
                <input type="number" id="product_id" name="product_id" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" required>
            </div>
            <button type="submit" class="btn-primary">Place Order</button>
        </form>
    </section>

    <section>
        <h2>Order History</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['product_id']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['order_date']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</main>

<?php include 'footer.php'; ?>
