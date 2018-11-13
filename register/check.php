<?php
session_start();
require_once('../dbconnect.php');

  echo '<pre>';
  var_dump($_SESSION);
  echo '</pre>';

$name = $_SESSION['register']['name'];
$email = $_SESSION['register']['email'];
$password = $_SESSION['register']['password'];

if(!empty($_POST)){

  // パスワードをハッシュ化
  $hash_password = password_hash($password, PASSWORD_DEFAULT);

  $sql = 'INSERT INTO users (name, email, password) VALUES (?, ?, ?)';
  $data = [$name, $email,$hash_password];
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  // unset($_SESSION['register']);
  header('Location: thank.php');
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>情報確認</title>
  <link rel="stylesheet" href="../css/main.css">
</head>
<body>
  <div class="header">
    <div class="row">
      <p class="logo">NexSeed Diary</p>
    </div>
  </div>

  <div class="form_box">
    <div class="title">情報確認</div>
    <form action="check.php" method="POST">

      <label>NAME</label>
      <p class="check"><?php echo $name?></p>

      <label>E-MAIL</label>
      <p class="check"><?php echo $email?></p>
      
      <label>PASSWORD</label>
      <p class="check">*********</p><br>

      <div class="btn"><input id="submit_button" type="submit" name="submit" value="登録"></div>
    </form>
    <div class="back-btn"><a href="signup.php"><button class="back">訂正</button></a></div>
  </div>

  <div class="footer">
    <div class="row">
      <p class="right"> Copy Right ©︎ NexSeed inc All Rights Reserved</p>
    </div>
  </div>
</body>
</html>
