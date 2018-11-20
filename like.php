<?php
    require_once('dbconnect.php');
// echo 'Hello, world!';

$user_id = $_POST['user_id'];
$diary_id = $_POST['diary_id'];


if(isset($_POST['dis_fav'])){
    $sql ='DELETE FROM `likes` WHERE `diary_id` = ? AND `user_id` = ?';
}else{
$sql = 'INSERT INTO `likes`SET `diary_id` = ?,`user_id` = ?';
}
$data = [$diary_id, $user_id];
$stmt = $dbh->prepare($sql);
$res = $stmt->execute($data);
// 結果を返す
// JavaScriotで使えるようにjsonエンコードして返す
echo json_encode($res);