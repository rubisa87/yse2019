<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title> 出勤管理システム</title>
<link rel="stylesheet" href="shop.css">
    <!-- <link rel="stylesheet" type="text/css" href="vendor/bootstrap.css"> -->
<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
  <!-- <title>jQuery UI Datepicker - Default functionality</title> -->
  <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <!-- // <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
  <!-- // <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
   <script>
  // $( function() {
  //   $( "#datepicker1" ).datepicker();
  //   $( "#datepicker2" ).datepicker();
  // } );
  // </script>
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
  $pdo = new PDO("mysql:dbname=seisaku", "root");
function floorp($val, $precision)
{
    $mult = pow(10, $precision); // Can be cached in lookup table        
    return floor($val * $mult) / $mult;
}
function no0($val){
if ($val==0){
    return "";
  }else{
    return $val;
  }
}
  ?>

<h2><br>
    給料計算実行
    </h2>

<table border="1" class="maintable" >
<tr><th>日付</th><th>コード</th><th>氏名</th><th>勤務時間</th><th>休憩時間</th><th>残業時間</th><th>深夜時間</th><th>一般給料</th><th>残業代</th><th>深夜代</th><th>交通費</th><th>操作</th></tr>
<?php
  $st = $pdo->query("SELECT * FROM kintaidata ");

  while ($row = $st->fetch()) {

        $id=htmlspecialchars($row['id']);
    $date = htmlspecialchars($row['date']);
    $passcode = htmlspecialchars($row['passcode']);
    $name = htmlspecialchars($row['name']);
    $kyuji = (strtotime($row['kksr'])-strtotime($row['kkks']))/3600;
    $kinji = (strtotime($row['tk'])-strtotime($row['sk']))/3600-$kyuji;
    $zanji=$kinji-8;
    $shinyaji =(strtotime($row['tk'])-strtotime("22:00:00"))/3600;
    if($zanji<0){
$zanji=0;
    }
    if($shinyaji<0){
$shinyaji=0;
    }
$stmt = $pdo->query("SELECT * FROM staffdata where passcode=$passcode");
$staff = $stmt->fetch();
$ippan=$kinji*$staff['jikyuu'];
$zangyoudai=$staff['jikyuu']*$zanji*0.25;
$shinyadai=$shinyaji*$staff['jikyuu']*0.25;
    // $kksr = htmlspecialchars($row['kksr']);
    // $tk = htmlspecialchars($row['tk']);
 //    if($kkks=="00:00:00"){ $kkks="";}
 //   if($kksr=="00:00:00"){ $kksr="";}
 //    if($tk=="00:00:00"){ $tk="";}
 // if($sk=="00:00:00"){ $sk="";}
    // echo "交通費：".$staff['koutsuuhi'];
        // echo "時給：".$staff['jikyuu']."<br>";
$koutsuuhi= $staff['koutsuuhi'];
   //print floorp(49.955, 2);
    $kyuji =floorp($kyuji, 2);
    $kinji = floorp($kinji, 2);
    $zanji=floorp($zanji, 2);
$ippan=floorp($ippan, 0);
$shinyaji=floorp($shinyaji, 2);
$zangyoudai=floorp($zangyoudai, 0);
$shinyadai=floorp($shinyadai, 0);

 echo "<div><tr><th>$date</th><th>$passcode</th><th>$name</th><th>$kinji</th><th>".no0($kyuji)."</th>";
 echo "<th>".no0($zanji)."</th><th>".no0($shinyaji)."</th><th>$ippan</th><th>".no0($zangyoudai)."</th><th>".no0($shinyadai)."</th><th>$koutsuuhi</th><th><a href='kintai_edit.php?id=$id '>修正</a></th></tr>";
    // echo "<div><tr><td>$date</td><td><input type='hidden' name='id' value=$id> $passcode</td><td>$name</td><td>$sk</td><td>$kkks</td><td>$kksr</td><td>$tk</td><td><a href='kintai_edit.php?id=$id '>修正</a></td></tr>";

  }




?>
    </body>
</html>
<!-- diff_hour = (strtotime($date2) - strtotime($date1)) / 3600; -->