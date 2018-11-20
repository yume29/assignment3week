<?php
require_once('dbconnect.php');
session_start();

if(!empty($_SESSION['register']['id'])){

  $user_id = $_SESSION['register']['id'];
  $sql = 'SELECT * FROM users WHERE id = ?';
  $data  = [$user_id];
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  $user = '';
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
  $user = $record;

}

    $post_id = $_GET['id'];
    $post_id = intval($post_id);


    $sql = 'SELECT u.name, d.* FROM diary AS d LEFT JOIN users AS u ON d.user_id = u.id WHERE d.id = ?';
    $data = [$post_id];
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    $diary = '';

    $record = $stmt->fetch(PDO::FETCH_ASSOC);


    // ログインしているユーザーがその投稿をお気に入りしているか確認

    $fav_flg_sql = 'SELECT * FROM `likes` WHERE `user_id` = ? AND `diary_id` = ?';
    $fav_flg_data = [ $user['id'], $record['id']];
    $fav_flg_stmt = $dbh->prepare( $fav_flg_sql );
    $fav_flg_stmt->execute( $fav_flg_data );
    $is_faved = $fav_flg_stmt->fetch( PDO::FETCH_ASSOC );
    // 三項演算子
    // 条件式 ? 真の場合:偽の場合;
    $record[ 'is_faved' ] = $is_faved ? true : false;

    // 投稿に対して何件いいねされているか取得
    $fav_sql = 'SELECT COUNT(*) AS `fav_count` FROM `likes` WHERE `diary_id` = ?';
    $fav_data = [$record['id']];
    $fav_stmt = $dbh->prepare( $fav_sql );
    $fav_stmt->execute( $fav_data );
    $result = $fav_stmt->fetch( PDO::FETCH_ASSOC );

    // feed１件ごとにいいねの数を新しく入れる
    $record[ 'fav_count' ] = $result[ 'fav_count' ];
// レコードがあれば追加

    $diary = $record;

    echo '<pre>';
    var_dump($record);
    echo '</pre>';


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
    <p class="writer">written by <?php echo $diary['name']?></p>
    <article><p class="post_font"><?php echo $diary['contents']?></p></article>
      
    <div>
    <?php if (isset($_SESSION['register']['id'])): ?>
      <?php if($diary['is_faved']== true):?>
      <button class="dis_fav"><span>お気に入り取り消し</span></button>
     <span hidden class="user_id"><?php echo $user['id']?></span>
      <span hidden class="diary_id"><?php echo $diary['id']?></span>
      <?php else:?>
      <button class="favorite"><span><img src="img/fav.jpg" alt=""></span></button><span class="fav_count"><?php echo $diary['fav_count']?></span>
      <span hidden class="user_id"><?php echo $user['id']?></span>
      <span hidden class="diary_id"><?php echo $diary['id']?></span>
      <?php endif ?>
    <?php endif ;?>
    </div>
  </div>



  <div class="footer">
    <div class="row">
      <p class="right"> Copy Right ©︎ NexSeed inc All Rights Reserved</p>
    </div>
  </div>
    <script type="text/javascript" src="js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="js/jquery-migrate-1.4.1.js"></script>
  <script type="text/javascript" src="js/like.js"></script>
</body>
</html>