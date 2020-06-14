<?php
session_start();
require('../dbconnect.php');

if (!empty($_POST)) {
    if ($_POST['name'] == '') {
        $error['name'] ='blank';
    }
    
    if ($_POST['email'] == '') {
        $error['email'] ='blank';
    }
    
    if (strlen($_POST['password']) < 4) {
        $error['password'] ='length';
    }
    
    if ($_POST['password'] == '') {
        $error['password'] ='blank';
    }

    $fileName = $_FILES['image']['name'];
    if (!empty($fileName)) {
        $ext = substr($fileName, -3);
        if ($ext != 'jpg' && $ext != 'gif' && $ext != 'png') {
            $error['image'] = 'type';
        }
    }

    //アカウントの重複をチェック
    if (empty($error)) {
        $member = $db->prepare('SELECT COUNT(*) AS cnt FROM members WHERE email=?');
        $member->execute(array($_POST['email']));
        $record = $member->fetch();
        if ($record['cnt'] > 0) {
            $error['email'] = 'duplicate';
        }
    }
    
    if (empty($error)) {
        $image = date('YmdHis') . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '../photos/' . $image);
        $_SESSION['join'] = $_POST;
        $_SESSION['join']['image'] = $image;
        header('Location: check.php');
        exit();
    }
}

if ($_REQUEST['action'] == 'rewrite' && isset($_SESSION['join'])) {
    $_POST = $_SESSION['join'];
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
            <li><a href="../login.php">ログイン</a></li>
            <li><a href="index.php">会員登録</a></li>
            </ul>
        </div>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <h1>会員登録</h1>
        <p>★ニックネーム<span>必須</span></p>
        <input type="text" name="name" style="font-size: 140%; width: 300px; border-radius: 10px;" value="<?php print(htmlspecialchars($_POST['name'], ENT_QUOTES)); ?>">
        <?php if ($error['name'] == 'blank'): ?>
        <p class="error">ニックネームが入力されていません</p>
        <?php endif; ?>

        <p>★メールアドレス<span>必須</span></p>
        <input type="email" name="email" style="font-size: 140%; width: 300px; border-radius: 10px;" value="<?php print(htmlspecialchars($_POST['email'], ENT_QUOTES)); ?> ">
        <?php if ($error['email'] == 'blank'): ?>
        <p class="error">メールアドレスが入力されていません</p>
        <?php endif; ?>
        <?php if ($error['email'] == 'duplicate'): ?>
        <p class="error">指定されたメールアドレスは既に登録されています</p>
        <?php endif; ?>

        <p>★パスワード<span>必須</span></p>
        <input type="password" name="password" style="font-size: 140%; width: 300px; border-radius: 10px;" value="<?php print(htmlspecialchars($_POST['password'], ENT_QUOTES)); ?> "><br><br>
        <?php if ($error['password'] == 'length'): ?>
        <p class="error">パスワードは４文字以上で入力してください</p>
        <?php endif; ?>
        <?php if ($error['password'] == 'blank'): ?>
        <p class="error">パスワードが入力されていません</p>
        <?php endif; ?>

        <p>★アイコン写真</p>
        <input type="file" name="image" >
        <?php if ($error['image'] == 'type'): ?>
        <p class="error">写真などは「.gif」または「.jpg」「.png」の画像を指定してください</p>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
        <p class="error">恐れ入りますが、画像を改めて指定してください</p>
        <?php endif; ?>
        <br><br>
        <input type="submit" value="確定" style="font-size: 150%;  width: 80px; border-radius: 10px;">
    </form>
</body>
</html>