<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>小徐的个人网站</title>
    <link rel="stylesheet" href="home_style.css">
    <style>
        #home, #notes, #gallery {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        #home {
            background-image: url('home/home_background.jpg');
            width: 900px;
            height: 900px;
            margin: 0 auto; /* Center the sections */
        }
        #notes {
            background-image: url('home/notes_background.jpg');
            width: 900px;
            height: 900px;
            margin: 0 auto; /* Center the sections */
        }
        #gallery {
            background-image: url('home/gallery_background.jpg');
            width: 900px;
            height: 900px;
            margin: 0 auto; /* Center the sections */
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            font-size: 16px;
            color: white;
            background-color: #007BFF;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            background-color: #f1f1f1;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>小徐的个人网站</h1>
    </header>
    <nav>
        <a href="#home">主页</a>
        <a href="#notes">天机泄露处</a>
        <a href="#gallery">展厅</a>
    </nav>
    <section id="home" class="home-content">
        <h2>欢迎来到我的个人网站！</h2>
        <p>这里是我的个人空间，分享我的生活点滴和创作。</p>
    </section>
    <section id="notes">
        <h2>天机泄露处</h2>
        <p>天机不可泄露</p>
        <a href="suibi.php" class="button">进入</a>
    </section>
    <section id="gallery">
        <h2>展厅</h2>
        <p>这里是我的展厅。</p>
        <a href="show_center.php" class="button">进入展厅主页</a>
    </section>
    <footer>
        <a href="shopping_center.php" class="redirect-button">进入购物网站</a>
    </footer>
</body>
</html>