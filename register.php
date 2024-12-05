<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注册</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container">
        <div class="sidebar">
            <?php include 'includes/sidebar.php'; ?>
        </div>
        <div class="main-content">
            <form method="post" action="register.php">
                用户名: <input type="text" name="username"><br>
                密码: <input type="password" name="password"><br>
                邮箱: <input type="email" name="email"><br>
                <input type="submit" value="注册">
            </form>
            <?php
            include 'includes/db.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST['username'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $email = $_POST['email'];

                $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
                if ($conn->query($sql) === TRUE) {
                    echo "注册成功";
                } else {
                    echo "错误: " . $sql . "<br>" . $conn->error;
                }
            }
            ?>
            <button onclick="history.back()">回到上一级</button>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>