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
      <li><a href="signup.php">新規読者登録</a></li>
      <li><a href="signin.php">ログイン</a></li>
      <li><a href="">マイページ</a></li>
      <li><a href="">いいねした記事</a></li>
      <li><a href="index.php">トップページへ</a></li>
    </ul>
  </div>

  <div class="form_box">
    <form action="insert.php" method="POST">

      <label>TITLE</label>
      <input type="text" name="title" placeholder="タイトル"><br>

      <label>BODY</label>
      <textarea name="contents" placeholder="本文"></textarea>
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