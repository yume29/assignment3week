<?php
require_once('../dbconnect.php');
session_start();

if(!empty($_POST)){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $errors = [];

  // ユーザー名の空チェック
  if($name == ''){
    $errors['name'] = 'blank';
  }
  // メールの空チェック
  if($email == ''){
    $errors['email'] = 'blank';
  }
  // パスワードの空チェック
  $count = strlen($password);
  if($password = ''){
    $errors['password'] == 'blank';
  }elseif ( $count < 4 || 16 < $count) {
    // 4~16文字の指定をつける
    $errors['password'] = 'length';
  }

  // エラーがなければセッションでcheck.phpに送信
  if(empty($errors)){

    $_SESSION['register'] = $_POST;

    header('Location: check.php');
    // exit();
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>会員登録</title>
  <link rel="stylesheet" href="../css/main.css">
</head>
<body>
  <div class="header">
    <div class="row">
      <p class="logo">NexSeed Diary</p>
    </div>
  </div>
  <div>
    <ul class="nav">
      <li><a href="signup.php">新規読者登録</a></li>
      <li><a href="../signin.php">ログイン</a></li>
      <li><a href="">マイページ</a></li>
      <li><a href="../insert_form.php">日記を書く</a></li>
      <li><a href="../index.php">トップページへ</a></li>
    </ul>
  </div>

  <div class="form_box">
    <div class="title">登録フォーム</div>
    <form action="signup.php" method="POST">

      <label>NAME</label>
      <input type="text" name="name" placeholder="名前"><br>
      <?php if(isset($errors['name']) && $errors['name'] == 'blank') :?>
        <p class="caution">名前が入力されていません</p>
      <?php endif;?>

      <label>E-MAIL</label>
      <input type="email" name="email" placeholder="メール"><br>
      <?php if(isset($errors['email']) && $errors['email'] == 'blank') :?>
        <p class="caution">メールアドレスが入力されていません</p>
      <?php endif;?>
      
      <label>PASSWORD</label>
      <input type="password" name="password" placeholder="パスワード"><br>
      <?php if(isset($errors['password']) && $errors['password'] == 'blank') :?>
        <p class="caution">パスワードが入力されていません</p>
      <?php endif;?>
      <?php if(isset($errors['password']) && $errors['password'] == 'length') :?>
        <p class="caution">パスワードは4~16文字で入力してください。</p>
      <?php endif;?>

      <div class="btn"><input id="submit_button" type="submit" name="submit" value="登録"></div>
      </form>
  </div>

  <div class="footer">
    <div class="row">
      <p class="right"> Copy Right ©︎ NexSeed inc All Rights Reserved</p>
    </div>
  </div>
</body>
</html>