<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheet.css"/>
    <title>Favorite Restaurant</title>
</head>
<body>
    <div class="header">
        <div class="header-logo">Favorite Restaurant</div>
        <div class="header-list">
            <ul>
            <li><a href="login.php">ログイン</a></li>
            <li><a href="join/index.php">会員登録</a></li>
            </ul>
        </div>
    </div>
    <form action="check.php" method="post">
        <h1>会員登録</h1>
        <p>★ニックネーム</p>
        <input type="text" name="name" style="font-size: 100%; width: 300px;">
        <p>★メールアドレス</p>
        <input type="email" name="email" style="font-size: 100%; width: 300px;">
        <p>★パスワード</p>
        <input type="password" name="password" style="font-size: 100%; width: 300px;"><br><br>
        <input type="submit" value="確定" style="font-size: 200%; width: 80px;">
    </form>
</body>
</html>