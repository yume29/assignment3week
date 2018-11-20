<?php
session_start();
require_once('dbconnect.php');

if(isset($_GET['signout'])){

    $_SESSION = [];
    // サーバー内の$_SESSIONをクリア
    session_destroy();
    // サインアウトしたあとの遷移
    header('location: index.php');
    exit();
}

if(!empty($_SESSION['register']['id'])){

  $user_id = $_SESSION['register']['id'];
  $sql = 'SELECT * FROM users WHERE id = ?';
  $data  = [$user_id];
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  $user = '';
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
  $user = $record;

}else{
  $_SESSION['register']['id'] = 'signout';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>会員登録</title>
  <link rel="stylesheet" href="css/main.css">
</head>
<body>
  <div class="header">
    <div class="row">
      <p class="logo">NexSeed Diary</p>
    </div>
  </div>
  <div>
    <ul class="nav">
      <li><a href="register/signup.php">新規読者登録</a></li>
      <li><a href="signin.php">ログイン</a></li>
      <li><a href="mypage.php">マイページ</a></li>
      <li><a href="insert_form.php">日記を書く</a></li>
      <li><a href="index.php">トップページへ</a></li>
    </ul>
  </div>

  <div class="form_box">

  <h2 class="user_info">User Info</h2>

    <div class="user_info">
    <p class="name">ユーザーネーム：<?php echo $user['name']?></p>
    <p class="email">メールアドレス：<?php echo $user['email']?></p>
    </div>

    <form action="mypage.php" method="GET">
      <input type="submit" id="signout" name="signout" value="サインアウト">
    </form>
  </div>

  <div class="footer">
    <div class="row">
      <p class="right"> Copy Right ©︎ NexSeed inc All Rights Reserved</p>
    </div>
  </div>
</body>
</html>