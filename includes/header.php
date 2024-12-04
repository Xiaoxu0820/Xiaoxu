<header>
    <h1>
        <img src="images/app_icon.jpg" alt="应用图标" style="width: 77px; height: 77px; vertical-align: middle;">
        欢迎来到小徐的在线购物网站！
    </h1>
    <nav>
        <a href="shopping_center.php">主页</a> |
        <a href="product_list_show.php">产品列表</a> |
        <a href="shopping_cart.php">购物车</a> |
        <a href="order_history.php">订单记录查询</a>
        <?php
        session_start();
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
            echo '| <a href="admin.php">管理员页面</a>';
        }
        ?>
    </nav>
</header>