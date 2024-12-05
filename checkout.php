<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>结账</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container">
        <div class="sidebar">
            <?php include 'includes/sidebar.php'; ?>
        </div>
        <div class="main-content">
            <h2>结账</h2>
            <form method="post" action="payment.php">
                总价/元: <input type="text" name="total_price" value="<?php echo htmlspecialchars($_POST['total_price']); ?>">
                <br>
                <input type="submit" value="付款">
            </form>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
</html>