<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title> 出勤管理システム</title>
<link rel="stylesheet" href="shop.css">
    <!-- <link rel="stylesheet" type="text/css" href="vendor/bootstrap.css"> -->
</head>
<body>
<!-- <h5> -->
<p class="top">
    <p1 class = "top1">
       <a href="main.php">打刻</a>
    </p1>
    &nbsp &nbsp 
    <p1 class = "top2">
        <a href="self.php">従業員</a>
    </p1>
&nbsp&nbsp
    <p1 class = "top3">
        <a href="kanri.php">管理人</a>
    </p1>
</p>
<br>
</p>
<?php
session_start();
 if ($_SESSION['kanri']==False){
    //③SESSIONの「error2」に「ログインしてください」と設定する。
    //④ログイン画面へ遷移する。
// }
    $_SESSION['error2'] ="ログインしてください";
    header("Location: self_login.php?page=kanri");//④ログイン画面へ遷移する。
} 
  ?>

<h2><br>
    勤怠データ修正
    </h2>


<form action ="kintai_edit2.php" method="post">

<table border="1" class="table" >
<tr><th>日付</th><th>コード</th><th>氏名</th><th>出勤</th><th>休憩開始</th><th>休憩終了</th><th>退勤</th><th>操作</th></tr>
<?php
 $id = $_GET['id'];
  
  $pdo = new PDO("mysql:dbname=seisaku", "root");
  $st = $pdo->prepare("SELECT * FROM kintaidata WHERE id=?");
  $st->execute(array($id));
  $row = $st->fetch();
?>
  <tr>
  <td><input type="text"  name="date" value="<?php echo $row["date"] ?>"></td>
  <td><input type="text" size ="8" name="passcode" value="<?php echo $row["passcode"] ?>"></td>
  <td><input type="text" name="name" value="<?php echo $row["name"] ?>"></td>
  <td><input type="text" size ="10" name="sk" value="<?php echo $row["sk"] ?>"></td>
  <td><input type="text" size ="10" name="kkks" value="<?php echo $row["kkks"] ?>"></td>
  <td><input type="text" size ="10" name="kksr" value="<?php echo $row["kksr"] ?>"></td>
  <td><input type="text" size ="10" name="tk" value="<?php echo $row["tk"] ?>"></td>
  
  <td><input type="hidden" name="id" value="<?php echo $id ?>">
  <input type="submit" value="確定"></td>
</tr>
</form>

</body>
</html>