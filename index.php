<?php
require_once('dbconnect.php');
require_once('insert.php');
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


// 保存した日記の取得
$sql = 'SELECT * FROM diary';
$stmt = $dbh->prepare($sql);
$stmt->execute();

$diaries = array();

while(true){

    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    if($record == false){
        break;
    }
    $diaries[] = $record;
}

if(isset($_GET['delete'])){
  $post_id = $_GET['id'];

  $sql = 'DELETE FROM diary WHERE id = ?';
  $data = [$post_id];
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);
  header('Location: index.php');
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Nexseed Diary</title>
  <link rel="stylesheet" href="css/diary.css">
  <script type="text/javascript"> 
    function check(){
      if(window.confirm('削除してよろしいですか？')){ // 確認ダイアログを表示
        return true; // 「OK」時は送信を実行
      }
      else{ // 「キャンセル」時の処理
        window.alert('キャンセルされました'); // 警告ダイアログを表示
        return false; // 送信を中止
      }
    }
</script>
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
      <li><a href="">いいねした記事</a></li>
      <li><a href="index.php">トップページへ</a></li>
    </ul>
  </div>

  <div class="side-box">
    <div class="user-box">
      <p class="guest"><?php echo $word?>、ゲストさん</p>
    </div>
    <div class="user-box">
        <a href="insert_form.php">日記を更新する</a>
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
    <?php foreach ($diaries as $diary) :?>
      <div class="contents">
        <a href="#" class="title"><?php echo $diary['title']?></a>
        <p class="created"><?php echo $diary['created']?></p>
        <form action="index.php" method="GET">
        <div class="btn"><input id="dlt_btn" type="submit" name="delete" value="削除" onClick="return check()"></div>
        <input class="post_id" type="hidden" name='id' value="<?php echo $diary['id']?>">
        </form>
      </div>
    <?php endforeach ;?>
  </div>
    <div class="footer">
      <div class="row">
        <p class="right"> Copy Right ©︎ NexSeed inc All Rights Preserved</p>
      </div>
  </div>
</body>
</html>