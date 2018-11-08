<?php
require_once('dbconnect.php');

// $sql = "INSERT INTO diary (title, contents, created) VALUES ('hogehoge', 'hogehoge', NOW()), ('hugahuga','hugahuga', NOW()),('mogemoge', 'mogemoge', NOW()), ('higehige', 'higehige', NOW()), ('munimuni', 'munimuni', NOW())";
// $stmt = $dbh->prepare($sql);
// $stmt->execute();
if(!empty($_POST)){

$title = $_POST['title'];
$contents = $_POST['contents'];

$sql = 'INSERT INTO diary (title, contents, created) VALUES (?, ?, NOW())';
$data = [$title, $contents];
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

header('Location: index.php');
exit();
}
?>