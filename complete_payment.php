<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>订单确认</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>订单确认</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
<?php
session_start();
include 'includes/db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $total_price = $_POST['total_price'];
    $sql = "INSERT INTO orders (user_id, total_price, status) VALUES ('$user_id', '$total_price', 'pending')";
    if ($conn->query($sql) === TRUE) {
        $order_id = $conn->insert_id;
        
        
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $product_id) {
                $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', 1, (SELECT price FROM products WHERE id='$product_id'))";
                $conn->query($sql);
            }
        } else {
            echo "购物车为空。";
        }
        
        // 生成确认链接
        $confirm_link = "http://8.138.153.1/confirm_order.php?order_id=$order_id";

        // 使用PHPMailer发送确认邮件
        $mail = new PHPMailer(true);
        try {
            // 服务器设置
            $mail->SMTPDebug = 0;                      // 关闭调试输出
            $mail->isSMTP();                           // 使用SMTP
            $mail->Host       = 'smtp.qq.com';    // SMTP服务器地址
            $mail->SMTPAuth   = true;                  // 启用SMTP认证
            $mail->Username   = '2368329759@qq.com'; // SMTP用户名
            $mail->Password   = 'krssqhejokopdida';       // 授权码
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // 启用TLS加密
            $mail->Port       = 587;                   // TCP端口

            // 收件人
            $mail->setFrom('2368329759@qq.com', 'Xiaoxu');
            $mail->addAddress($_SESSION['email']);     // 添加收件人

            // 内容
            $mail->isHTML(true);                       // 设置邮件格式为HTML
            $mail->Subject = '订单确认';
            $mail->Body    = "您的订单已确认。请点击以下链接确认您的订单: <a href='$confirm_link'>$confirm_link</a>";

            $mail->send();
            echo '确认邮件已发送，请检查您的邮箱。';
        } catch (Exception $e) {
            echo "邮件发送失败: {$mail->ErrorInfo}";
        }
    } else {
        echo "错误: " . $sql . "<br>" . $conn->error;
    }
}
?>

<?php
session_start();
if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
    echo '——————已为您清空购物车中商品——————';
} else {
    echo 'error: fail to clear the cart';
}
?>

<a href="shopping_center.php" class="home-button">回到主页</a>
</body>
</html>