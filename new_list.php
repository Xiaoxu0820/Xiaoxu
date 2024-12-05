<?php
include 'includes/db.php';

$sql = "SELECT * FROM products ORDER BY created_at DESC LIMIT 7";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        include 'templates/product_item.php';
    }
} else {
    echo "没有产品";
}
?>