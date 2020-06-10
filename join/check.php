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
    <form action="thanks.php" method="post">

        <?php
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        ?>


        <h1>会員登録</h1>
        <p>★ニックネーム</p>
        <?php if ($name == ''): ?> 
        <p class='error'>※お名前が入力されていません</p>
        <br>
        <?php else: ?>
        <?php
        print $name;
        print '<br>';
        ?>
        <?php endif; ?> 

        <p>★メールアドレス</p>
        <?php if ($email == ''): ?> 
        <p class="error">※メールアドレスが入力されていません</p>
        <br>
        <?php else: ?>
        <?php
        print $email;
        print '<br>';
        ?>
        <?php endif; ?> 
        
        <p>★パスワード</p>
        <?php if ($password == ''): ?> 
        <p class="error">※パスワードが入力されていません</p>
        <br>
        <?php else: ?>
        <?php
        print $password;
        print '<br>';
        ?>
        <?php endif; ?> 

        <br><input type="button" value="戻る" onClick="history.back()" style="font-size: 100%">
        |
        <?php if ($name !=='' & $email !=='' & $password !== ''): ?>
        <input type="submit" value="確定する" style="font-size: 100%">   
        <?php endif; ?>
    </form>
</body>
</html>