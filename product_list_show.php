<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品列表</title>
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
            <h2>商品列表</h2>
            <div id="product-list">
                <!-- 商品列表将通过JavaScript动态加载 -->
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>