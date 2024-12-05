<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>上传头像</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container">
        <div class="sidebar">
            <?php include 'includes/sidebar.php'; ?>
        </div>
        <div class="main-content">
            <h2>上传头像</h2>
            <form action="upload_avatar.php" method="post" enctype="multipart/form-data">
                选择头像: <input type="file" name="avatar" accept=".jpg"><br>
                <input type="submit" value="上传">
            </form>
            <?php
            session_start();
            include 'includes/db.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // 检查文件是否为图片
                $check = getimagesize($_FILES["avatar"]["tmp_name"]);
                if ($check !== false) {
                    // 检查文件格式
                    if ($imageFileType == "jpg") {
                        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                            $username = $_SESSION['username'];
                            $sql = "UPDATE users SET avatar='$target_file' WHERE username='$username'";
                            if ($conn->query($sql) === TRUE) {
                                $_SESSION['avatar'] = $target_file;
                                echo "头像上传成功";
                            } else {
                                echo "数据库更新失败: " . $conn->error;
                            }
                        } else {
                            echo "文件上传失败";
                        }
                    } else {
                        echo "只允许上传 .jpg 格式的文件";
                    }
                } else {
                    echo "文件不是图片哦";
                }
            }
            ?>
            <button onclick="history.back()">回到上一级</button>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>