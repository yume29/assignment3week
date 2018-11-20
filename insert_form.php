<?php
require_once('dbconnect.php');
session_start();



if ( empty( $_SESSION ) || $_SESSION[ 'register' ][ 'id' ] == 'signout') {
  header( 'Location: register/signup.php' );
  exit();
}

if(isset($_SESSION['register']['id'])){

  $user_id = $_SESSION['register']['id'];

  $sql = 'SELECT * FROM users WHERE id = ?';
  $data  = [$user_id];
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  $user = '';
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
  $user = $record;

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>投稿</title>
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
    <form action="insert.php" method="POST">

      <label>TITLE</label>
      <input type="text" name="title" placeholder="タイトル"><br>

      <label>BODY</label>
      <textarea name="contents" placeholder="本文"></textarea>
      <input type="hidden" name="user_id" value="<?php echo $user['id']?>">
      <div class="btn"><input id="submit_button" type="submit" name="submit" value="投稿"></div>
      </form>
  </div>

  <div class="footer">
    <div class="row">
      <p class="right"> Copy Right ©︎ NexSeed inc All Rights Reserved</p>
    </div>
  </div>
</body>
</html>