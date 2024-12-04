<div class="sidebar">
    <?php
    if (isset($_SESSION['username'])) {
        echo "<h3>欢迎, " . $_SESSION['username'] . "</h3>";
        if (isset($_SESSION['avatar'])) {
            echo "<img src='" . $_SESSION['avatar'] . "' alt='头像' style='width:100px;height:100px;border-radius:50%;'><br>";
        }
        echo "<button onclick=\"location.href='upload_avatar.php'\">上传头像</button>";
        if ($_SESSION['role'] == 'admin') {
            echo "<br><button onclick=\"location.href='admin.php'\">管理页面</button>";
        }
        echo "<br><button onclick=\"location.href='logout.php'\">退出登录</button>";
    } else {
        echo "<h3>当前未登录</h3>";
        echo "<button onclick=\"location.href='login.php'\">登录</button>";
        
        echo "<br><button onclick=\"location.href='admin_login.php'\">管理员登录</button>";
        
        echo "<br><button onclick=\"location.href='register.php'\">注册</button>";
    }
    
    ?>
</div>
