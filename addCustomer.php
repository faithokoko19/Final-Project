<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
</head>
<body>
    <h1>Add New Customer</h1>
    <form action="index.php?action=addCustomer" method="POST">
        <label for="customer_name">Customer Name:</label>
        <input type="text" name="customer_name" required><br><br>

        <label for="contact_info">Contact Info:</label>
        <input type="text" name="contact_info" required><br><br>

        <button type="submit">Add Customer</button>
    </form>
    <a href="index.php">Back to Home</a>
</body>
</html>
