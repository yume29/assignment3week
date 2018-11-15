<?php
require_once('dbconnect.php');

// $sql = "INSERT INTO diary (title, contents, created) VALUES ('hogehoge', 'hogehoge', NOW()), ('hugahuga','hugahuga', NOW()),('mogemoge', 'mogemoge', NOW()), ('higehige', 'higehige', NOW()), ('munimuni', 'munimuni', NOW())";
// $stmt = $dbh->prepare($sql);
// $stmt->execute();
if(!empty($_POST)){

$title = $_POST['title'];
$contents = $_POST['contents'];
$user_id = $_POST['user_id'];

$sql = 'INSERT INTO diary (title, contents, user_id, created) VALUES (?, ?, ?, NOW())';
$data = [$title, $contents, $user_id];
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

header('Location: index.php');
exit();
}
?>
