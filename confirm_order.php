<?php
session_start();
include 'includes/db.php';

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $sql = "UPDATE orders SET status='confirmed' WHERE id='$order_id'";

    if ($conn->query($sql) === TRUE) {
        echo "订单已确认";
        // 这里可以添加后续处理逻辑，例如发送进一步的通知邮件等
    } else {
        echo "错误: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "无效的请求";
}
?>