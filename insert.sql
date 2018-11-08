<?php

$sql = "INSERT INTO diary (title, contents, created) VALUES ('hogehoge', 'hogehoge', NOW()), ('hugahuga','hugahuga', NOW()),('mogemoge', 'mogemoge', NOW()), ('higehige', 'higehige', NOW()), ('munimuni', 'munimuni', NOW())";
$stmt = $dbh->prepare($sql);
$stmt->execute();

?>