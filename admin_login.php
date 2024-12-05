<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理员登录</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container">
        <div class="sidebar">
            <?php include 'includes/sidebar.php'; ?>
        </div>
        <div class="main-content">
            <form method="post" action="admin_login.php">
                用户名: <input type="text" name="username"><br>
                密码: <input type="password" name="password"><br>
                <input type="submit" value="登录">
            </form>
            <?php
            include 'includes/db.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $sql = "SELECT * FROM users WHERE username='$username' AND role='admin'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    if (password_verify($password, $row['password'])) {
                        session_start();
                        $_SESSION['username'] = $username;
                        $_SESSION['user_id'] = $row['id'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['avatar'] = $row['avatar'];
                        $_SESSION['role'] = $row['role'];
                        header("Location: admin.php");
                    } else {
                        echo "密码错误";
                    }
                } else {
                    echo "用户不存在或没有管理员权限";
                }
            }
            ?>
            <button onclick="history.back()">回到上一级</button>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>