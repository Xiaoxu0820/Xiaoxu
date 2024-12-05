<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>订单历史</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container">
        <div class="sidebar">
            <?php include 'includes/sidebar.php'; ?>
        </div>
        <div class="main-content">
            <h2>订单历史</h2>
            <?php
            session_start();
            include 'includes/db.php';

            $user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM orders WHERE user_id='$user_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "订单号: " . $row['id'] . " - 总价: " . $row['total_price'] . " - 状态: " . $row['status'] . " - 购买时间: " . $row['created_at'] ."<br>";
                }
            } else {
                echo "没有订单";
            }
            ?>
            <button onclick="history.back()">回到上一级</button>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>