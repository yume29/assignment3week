<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>投稿フォーム</title>
  <link rel="stylesheet" href="insert_form.css">
</head>
<body>
  <div class="header">
    <div class="row">
      <p class="logo">NexSeed Diary</p>
    </div>
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
      <p class="right"> Copy Right ©︎ NexSeed inc All Rights Preserved</p>
    </div>
  </div>
</body>
</html>