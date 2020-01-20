<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="uft-8">
<meta http-equiv="refresh" content="2;URL=kanri.php">
<title>出勤管理</title>
</head>
<body>
<!-- <p><a href="move/newpage.html">移転先のページ</a></p> -->



<?php
  $pdo = new PDO("mysql:dbname=seisaku", "root");
  $st = $pdo->prepare("UPDATE kintaidata SET date=?, passcode=?, name=?, sk=?, kkks=?, kksr=?, tk=? WHERE id=?");
  $st->execute(array($_POST['date'],$_POST['passcode'],$_POST['name'], $_POST['sk'],$_POST['kkks'],$_POST['kksr'],$_POST['tk'],$_POST['id'],));
require "kanri.php"; 
echo "情報を修せしました。"
?>

</body>
</html>

 