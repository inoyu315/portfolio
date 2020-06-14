<?php 
session_start();
require('../dbconnect.php');

if (!isset($_SESSION['join'])) {
    header('Location: index.php');
    exit();
}

if (!empty($_POST)) {
    $statement = $db->prepare('INSERT INTO members SET name=?, email=?, password=?, profile_picture=?, created=NOW()');
    echo $statement->execute(array(
        $_SESSION['join']['name'],
        $_SESSION['join']['email'],
        sha1($_SESSION['join']['password']),
        $_SESSION['join']['image']
    ));
    unset($_SESSION['join']);

    header('Location: thanks.php');
    exit();
}
?>

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
            <li><a href="index.php">会員登録</a></li>
            </ul>
        </div>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="action" value="action" value="submit">

        <h1>会員登録</h1>
        <p>★ニックネーム</p>
        <?php print(htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES)); ?>

        <p>★メールアドレス</p>
        <?php print(htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES)); ?>
        
        <p>★パスワード</p>
        <p>【パスワードは表示されません】</p>

        <p>★アイコン写真</p>
        <?php if ($_SESSION['join']['image'] !== ''): ?>
            <img src="../photos/<?php print(htmlspecialchars($_SESSION['join']['image'], ENT_QUOTES)); ?>" >
        <?php endif; ?>

        <br><a href="index.php?action=rewrite">戻る</a>
        |
        <?php if ($name !=='' & $email !=='' & $password !== ''): ?>
        <input type="submit" value="確定する" style="font-size: 100%; border-radius: 10px; width: 75px;">   
        <?php endif; ?>
    </form>
</body>
</html>