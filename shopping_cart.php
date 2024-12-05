<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>购物车</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container">
        <div class="sidebar">
            <?php include 'includes/sidebar.php'; ?>
        </div>
        <div class="main-content">
            <h2>您的购物车</h2>
            <?php
            session_start();
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                include 'includes/db.php';
                $cart = $_SESSION['cart'];
                $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
                $total_price = 0;
                foreach ($cart as $product_id) {
                    $stmt->bind_param("i", $product_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $total_price += $row['price'];
                            include 'templates/product_item.php'; // Updated path
                        }
                    }
                }
                $stmt->close();
                echo '<form method="post" action="checkout.php">';
                echo '<input type="hidden" name="total_price" value="' . htmlspecialchars($total_price) . '">';
                echo '<input type="submit" value="去结账">';
                echo '</form>';
                $conn->close();
            } else {
                echo "购物车为空";
            }
            
            ?>
            <button onclick="history.back()">回到上一级</button>
     
     <button class="clear-cart-button" onclick="clearCart()">清空购物车</button>
     
     <script>
        function clearCart() {
            fetch('clear_cart.php', {
                method: 'POST'
            })
            .then(response => response.text())
            .then(data => {
                if (data === 'success') {
                    alert('购物车已清空');
                    location.reload();
                } else {
                    alert('清空购物车失败');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
    
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>