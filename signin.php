<?php
require_once('dbconnect.php');
session_start();

$errors = [];
$email = '';

// ログインボタンが押されたら
// $_POSTがからじゃなければ

if(!empty($_POST)){
  $email = $_POST['email'];
  $password = $_POST['password'];

  // DBと照合する
  // バリデーション
    if( $email != '' && $password != ''){


        $sql = 'SELECT * FROM users WHERE email = ?';
        $data = [$email];
        $stmt = $dbh->prepare($spl);
        $stmt = execute($data);
        // オブジェクト型から、配列型へ
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        // 登録されたemailならtrueが返ってくる
        if($record == false){
            $errors['signin'] = 'failed';
        }

    // パスワードの一致チェック
        if(password_verify($password, $record['password'])){

            header('Location: index.php');
        }else{
      // 認証失敗
            $errors['signin'] = 'failed';
        }
    }else{
        $errors['signin'] = 'blank';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ログイン</title>
  <link rel="stylesheet" href="css/main.css">
</head>
<body>
  <div class="header">
    <div class="row">
      <p class="logo">NexSeed Diary</p>
    </div>
  </div>

  <div class="form_box">
    <form action="" method="POST">

      <label>E-MAIL</label>
      <input type="email" name="email" placeholder="登録したE-mailアドレス"><br>

      <label>PASSWORD</label>
      <input type="password" name="password" placeholder="パスワード"><br>

      <div class="btn"><input id="submit_button" type="submit" name="submit" value="ログイン"></div>
      </form>
  </div>

  <div class="footer">
    <div class="row">
      <p class="right"> Copy Right ©︎ NexSeed inc All Rights Rserved</p>
    </div>
  </div>
</body>
</html>