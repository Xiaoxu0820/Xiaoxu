<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>支付</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <div class="main-content">
            <h2>支付</h2>
            <img src="images/pay.jpg" alt="支付图片" style="display: block; margin: 0 auto;">
            <p style="text-align: center;">需要支付的总价为: <?php echo htmlspecialchars($_POST['total_price']); ?>元。</p>
            <form method="post" action="complete_payment.php">
                <input type="hidden" name="total_price" value="<?php echo htmlspecialchars($_POST['total_price']); ?>">
                <div style="text-align: right;">
                    <input type="submit" value="完成支付">
                </div>
            </form>
        </div>
    </div>
</body>
</html>