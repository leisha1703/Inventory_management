<?php include 'header.php'; ?>
<?php include 'db.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $supplier_id = $_POST['supplier_id'];

    $sql = "INSERT INTO inventory (product_name, quantity, supplier_id) VALUES ('$product_name', $quantity, $supplier_id)";
    if ($conn->query($sql) === TRUE) {
        $success_message = "New product added successfully";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}

$sql = "SELECT * FROM inventory";
$result = $conn->query($sql);
?>

<main>
    <section>
        <h2>Add New Product</h2>
        <?php if (isset($success_message)) { ?>
            <div class="alert success"><?php echo $success_message; ?></div>
        <?php } ?>
        <?php if (isset($error_message)) { ?>
            <div class="alert error"><?php echo $error_message; ?></div>
        <?php } ?>
        <form action="inventory.php" method="POST">
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" id="product_name" name="product_name" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="supplier_id">Supplier</label>
                <input type="number" id="supplier_id" name="supplier_id">
            </div>
            <button type="submit" class="btn-primary">Add Product</button>
        </form>
    </section>

    <section>
        <h2>Current Inventory</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Supplier ID</th>
                    <th>Last Updated</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['supplier_id']; ?></td>
                        <td><?php echo $row['last_updated']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</main>

<?php include 'footer.php'; ?>
