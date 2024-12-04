<div class="product" style="display: flex; align-items: center;">
    <div style="flex: 1;">
        <h2><?php echo htmlspecialchars($row['name']); ?></h2>
        <p><?php echo htmlspecialchars($row['description']); ?></p>
        <p>价格: <?php echo htmlspecialchars($row['price']); ?>元</p>
        <?php if (basename($_SERVER['PHP_SELF']) != 'shopping_cart.php'): ?>
            <form method="post" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                <input type="submit" value="添加到购物车">
            </form>
        <?php endif; ?>
    </div>
    <div style="flex: 0 0 auto; margin-left: 20px;">
        <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" style="width: 100px; height: 100px; object-fit: cover;">
    </div>
</div>