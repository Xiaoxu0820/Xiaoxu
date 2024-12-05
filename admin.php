<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理页面</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container">
        <div class="sidebar">
            <?php include 'includes/sidebar.php'; ?>
        </div>
        <div class="main-content">
            <h2>管理页面</h2>
            <!-- 商品目录管理 -->
            <h3>上架新商品</h3>
            <form method="post" action="admin.php">
                产品名称: <input type="text" name="name"><br>
                描述: <input type="text" name="description"><br>
                价格: <input type="text" name="price"><br>
                <input type="submit" name="add_product" value="添加产品">
            </form>
            <?php
            include 'includes/db.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $sql = "INSERT INTO products (name, description, price) VALUES ('$name', '$description', '$price')";
                $conn->query($sql);
            }
            echo "<button onclick=\"location.href='upload_image.php'\">上传商品图片</button>";
             // 查看当前货物信息
            echo "<h3>当前货物信息</h3>";
            $sql = "SELECT * FROM products ORDER BY id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "序号: " . $row['id'] . " - 产品名称: " . $row['name'] . " - 描述: " . $row['description'] . " - 价格: " . $row['price'] . "<br>";
                    
                    echo "<form method='post' action='admin.php'>
                            <input type='hidden' name='product_id' value='" . $row['id'] . "'>
                            序号: <input type='number' name='id' value='" . $row['id'] . "'><br>
                            产品名称: <input type='text' name='name' value='" . $row['name'] . "'><br>
                            描述: <input type='text' name='description' value='" . $row['description'] . "'><br>
                            价格: <input type='text' name='price' value='" . $row['price'] . "'><br>
                            <input type='submit' name='update_id' value='更新序号'>
                            <input type='submit' name='update_product' value='更新产品'>
                            <input type='submit' name='delete_product' value='下架产品'>
                          </form>";
                }
            }
            // 更新商品序号
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_id'])) {
                $product_id = $_POST['product_id'];
                $id = $_POST['id'];
                $sql = "UPDATE products SET id='$id' WHERE id='$product_id'";
                $conn->query($sql);
                header("Location: admin.php");
            }
            // 更新或删除商品
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_product'])) {
                $product_id = $_POST['product_id'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $sql = "UPDATE products SET name='$name', description='$description', price='$price' WHERE id='$product_id'";
                $conn->query($sql);
                // Move header call before any output
                echo "<script>window.location.href='admin.php';</script>";
                exit();
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_product'])) {
                $product_id = $_POST['product_id'];
                $sql = "DELETE FROM products WHERE id='$product_id'";
                $conn->query($sql);
                // Move header call before any output
                echo "<script>window.location.href='admin.php';</script>";
                exit();
            }

            // 更新商品序号
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_id'])) {
                $product_id = $_POST['product_id'];
                $id = $_POST['id'];
                $sql = "UPDATE products SET id='$id' WHERE id='$product_id'";
                $conn->query($sql);
                // Move header call before any output
                echo "<script>window.location.href='admin.php';</script>";
                exit();
            }

            // 查看当前订单信息
            echo "<h3>当前订单信息</h3>";
            $sql = "SELECT * FROM orders";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "订单号: " . $row['id'] . " - 用户ID: " . $row['user_id'] . " - 总价: " . $row['total_price'] . " - 状态: " . $row['status'] . "<br>";
                    echo "<form method='post' action='admin.php'>
                            <input type='hidden' name='order_id' value='" . $row['id'] . "'>
                            状态: <select name='status'>
                                <option value='pending' " . ($row['status'] == 'pending' ? 'selected' : '') . ">待处理</option>
                                <option value='shipped' " . ($row['status'] == 'shipped' ? 'selected' : '') . ">已发货</option>
                                <option value='completed' " . ($row['status'] == 'completed' ? 'selected' : '') . ">已完成</option>
                            </select>
                            <input type='submit' name='update_order' value='更新订单'>
                            <input type='submit' name='delete_order' value='删除订单'>
                          </form>";
                }
            }

            // 更新订单状态
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_order'])) {
                $order_id = $_POST['order_id'];
                $status = $_POST['status'];
                $sql = "UPDATE orders SET status='$status' WHERE id='$order_id'";
                $conn->query($sql);
                // Move header call before any output
                echo "<script>window.location.href='admin.php';</script>";
                exit();
            }
            // 删除订单
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_order'])) {
                $order_id = $_POST['order_id'];
                $status = $_POST['status'];
                $sql = "DELETE FROM order_items WHERE order_id='$order_id'";
                $conn->query($sql);
                $sql = "DELETE FROM orders WHERE id='$order_id'";
                $conn->query($sql);
                // Move header call before any output
                echo "<script>window.location.href='admin.php';</script>";
                exit();
            }
            // 销售统计报表
            echo "<h3>销售统计报表</h3>";
            $sql = "SELECT product_id, SUM(quantity) as total_quantity, SUM(price * quantity) as total_sales FROM order_items GROUP BY product_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $product_id = $row['product_id'];
                    $product_sql = "SELECT name FROM products WHERE id='$product_id'";
                    $product_result = $conn->query($product_sql);
                    $product_name = $product_result->fetch_assoc()['name'];
                    echo "产品名称: " . $product_name . " - 销售数量: " . $row['total_quantity'] . " - 总销售额: " . $row['total_sales'] . "<br>";
                }
            }

            // 客户管理
            echo "<h3>客户管理</h3>";
            $sql = "SELECT * FROM users WHERE role='user'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo  "用户ID: " . $row['id'] . " - 用户名: " . $row['username'] . " - 邮箱: " . $row['email'] . "<br>";
                }
            }

            // 浏览/购买日志记录
            echo "<h3>浏览/购买日志记录</h3>";
            $sql = "SELECT * FROM orders";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "订单号: " . $row['id'] . " - 用户ID: " . $row['user_id'] . " - 总价: " . $row['total_price'] . " - 状态: " . $row['status'] . "<br>";
                }
            }
            ?>
            <button onclick="history.back()">回到上一级</button>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>