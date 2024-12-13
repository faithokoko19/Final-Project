<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Preferences</title>
</head>
<body>

<h1>View Customer Preferences</h1>


<form method="GET" action="index.php">
    <label for="customerId">Enter Customer ID:</label>
    <input type="text" name="customerId" id="customerId" required>
    <button type="submit">View Preferences</button>
</form>

<?php if (isset($preferences)): ?>
    <h2>Customer Preferences</h2>
    <?php if ($preferences): ?>
        <p><strong>Preferences:</strong> <?= htmlspecialchars($preferences) ?></p>
    <?php else: ?>
        <p>No preferences found for this customer.</p>
    <?php endif; ?>
<?php elseif (isset($message)): ?>
    <p><strong><?= htmlspecialchars($message) ?></strong></p>
<?php endif; ?>


<a href="index.php">Back to home</a>

</body>
</html>
