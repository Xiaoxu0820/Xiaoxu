<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>在线购物网站</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js" defer></script>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="container">
        <div class="sidebar">
            <?php include 'includes/sidebar.php'; ?>
        </div>
        <div class="main-content">
            <h2>最新商品</h2>
            <div id="new-product-list">
                <!-- 商品列表将通过JavaScript动态加载 -->
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>