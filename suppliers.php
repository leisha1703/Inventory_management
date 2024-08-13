<?php include 'header.php'; ?>
<?php include 'db.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $contact_info = $_POST['contact_info'];

    $sql = "INSERT INTO suppliers (name, contact_info) VALUES ('$name', '$contact_info')";
    if ($conn->query($sql) === TRUE) {
        $success_message = "New supplier added successfully";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}

$sql = "SELECT * FROM suppliers";
$result = $conn->query($sql);
?>

<main>
    <section>
        <h2>Add New Supplier</h2>
        <?php if (isset($success_message)) { ?>
            <div class="alert success"><?php echo $success_message; ?></div>
        <?php } ?>
        <?php if (isset($error_message)) { ?>
            <div class="alert error"><?php echo $error_message; ?></div>
        <?php } ?>
        <form action="suppliers.php" method="POST">
            <div class="form-group">
                <label for="name">Supplier Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="contact_info">Contact Information</label>
                <input type="text" id="contact_info" name="contact_info">
            </div>
            <button type="submit" class="btn-primary">Add Supplier</button>
        </form>
    </section>

    <section>
        <h2>Supplier List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Contact Information</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['contact_info']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</main>

<?php include 'footer.php'; ?>
