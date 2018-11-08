<?php
require_once('dbconnect.php');
require_once('insert.sql');
date_default_timezone_set('Asia/Manila');
$time = intval(date('H:i:s'));

// 挨拶の変換
if ('6:00:00' <= $time && $time <= '11:00:59') {
    $word ='おはようございます';
} elseif ('11:01:00' <= $time && $time <= '17:59:59') {
    $word ='こんにちは';
} else {
    $word = 'こんばんは';
}

// 過去三ヶ月の記事欄
$month_box1 = date('Y-m', strtotime('-1 month'));
$month_box1 = date('Y年m月', strtotime($month_box1));

$month_box2 = date('Y-m', strtotime('-2 month'));
$month_box2 = date('Y年m月', strtotime($month_box2));

$month_box3 = date('Y-m', strtotime('-3 month'));
$month_box3 = date('Y年m月', strtotime($month_box3));



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Nexseed Diary</title>
  <link rel="stylesheet" href="diary.css">
</head>
<body>
  <div class="header">
    <div class="row">
      <p class="logo">NexSeed Diary</p>
    </div>
  </div>

  <div class="side-box">
    <div class="user-box">
      <p class="guest"><?php echo $word?>、ゲストさん</p>
    </div>
    <div class="month-box">
      <a href="#"><?php echo $month_box1 ?>の日記</a>
    </div>
    <div class="month-box">
      <a href="#"><?php echo $month_box2 ?>の日記</a>
    </div>
    <div class="month-box">
      <a href="#"><?php echo $month_box3 ?>の日記</a>
    </div>
  </div>

  <div class="diary-box">
    <div class="contents">
      <a href="#" class="title">こんにちは</a>
      <p class="created">2018/10/31</p>
    </div>
    <div class="contents">
      <a href="#" class="title">こんにちは</a>
      <p class="created">2018/10/31</p>
    </div>
    <div class="contents">
      <a href="#" class="title">こんにちは</a>
      <p class="created">2018/10/31</p>
    </div>
    <div class="contents">
      <a href="#" class="title">こんにちは</a>
      <p class="created">2018/10/31</p>
    </div>
    <div class="contents">
      <a href="#" class="title">こんにちは</a>
      <p class="created">2018/10/31</p>
    </div>
  </div>
    <div class="footer">
      <div class="row">
        <p class="right"> Copy Right ©︎ NexSeed inc All Rights Preserved</p>
      </div>
  </div>

</body>
</html>