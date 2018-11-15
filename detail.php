<?php
require_once('dbconnect.php');


    $post_id = $_GET['id'];
    $post_id = intval($post_id);


    $sql = 'SELECT * FROM diary WHERE id = ?';
    $data = [$post_id];
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    $diary = '';

    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    $diary = $record;


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
      <li><a href="">マイページ</a></li>
      <li><a href="insert_form.php">日記を書く</a></li>
      <li><a href="index.php">トップページへ</a></li>
    </ul>
  </div>

  <div class="post_box">

    <h2 class="post_title"><?php echo $diary['title']?></h2>
    <p class="created"><?php echo $diary['created']?></p>
    <article><p class="post_font"><?php echo $diary['contents']?></p></article>
  </div>

  <div class="footer">
    <div class="row">
      <p class="right"> Copy Right ©︎ NexSeed inc All Rights Reserved</p>
    </div>
  </div>
</body>
</html>