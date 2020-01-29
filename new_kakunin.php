<?php

session_start();

function getByid($id,$con){
	
$sql = "select * from books where books.id=$id ";
		$result = $con->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return $row;
			}	
		}
	//③実行した結果から1レコード取得し、returnで値を返す。
}
function deleteByid($id,$con){
	
$sql = "UPDATE books SET deleflag =1 where books.id=$id ";
		return $result = $con->query($sql);
	//③実行した結果から1レコード取得し、returnで値を返す。
}
function updateByid($id,$con,$total){

	$sql = "UPDATE books SET stock=$total WHERE id=$id";
		return $result = $con->query($sql);


}


if ($_SESSION["login"] ==False){
	//④SESSIONの「error2」に「ログインしてください」と設定する。
	$_SESSION['error2'] ="ログインしてください";
	header("Location: login.php");//④ログイン画面へ遷移する。
	
}


$con = mysqli_connect("localhost" , "zaiko2019" , "2019zaiko" , "zaiko2019_yse");
	mysqli_set_charset($con,"UTF8");

	$count=0;

// foreach($_POST['books'] as $books ){

	
// 	$dtb=getByid($books,$con);
	
// 	$count++;
// }

if(@$_POST['delete']=="ok"/* ㉓の処理を書く */){
$count=0;
$result;
	foreach($_POST['books']as $books/* ㉕の処理を書く */){
		$result=deleteByid($books,$con);
$count++;
	}



if($result){
	$_SESSION['success'] ="削除が完了しました";
	header("Location: zaiko_ichiran.php");//④ログイン画面へ遷移する。
}
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>削除確認</title>
<link rel="stylesheet" href="css/ichiran.css" type="text/css" />
</head>
<body>
<div id="header">
	<h1>削除確認</h1>
</div>
<form action="delete_kakunin.php" method="post" id="test">
	<div id="pagebody">
		<div id="center">
			<table>
				<thead>
					<tr>
						<th id="book_name">書籍名</th>
						<th id="stock">在庫数</th>
					</tr>
				</thead>
				<tbody>
					<?php 
				$_SESSION['chuui']="";
			$count=0;
					
		foreach ($_POST['books'] as $books){
					$a =getbyId($books,$con);

					?>
					<tr>
						<td><?php echo	$a['title']/* ㉟ ㉞で取得した書籍情報からtitleを表示する。 */;?></td>
						<td><span style="color: red"><?php echo	$a['stock']/* ㊱ ㉞で取得した書籍情報からstockを表示する。 */;

						if($a['stock']>0){
							$_SESSION['chuui']="在庫ある商品がありますが、";
						}
																							?></span></td>

					</tr>
					<input type="hidden" name="books[]" value="<?php echo $books/* ㊳ ㉝で取得した値を設定する */;?>">

					<?php
					$count++;
					}
					?>
				</tbody>
			</table>
			<div id="kakunin">
				<p>
					<span style="color: red"><?php echo $_SESSION['chuui'] ?></span>上記の書籍を削除します。<br>
					よろしいですか？
				</p>
				<button type="submit" id="message" formmethod="POST" name="delete" value="ok">はい</button>
				<button type="submit" id="message"  formmethod="POST" name="delete" value="stop"　formaction="nyuka.php">いいえ</button>
			</div>
		</div>
	</div>
</form>
<div id="footer">
	<footer>株式会社アクロイト</footer>
</div>
</body>
</html>
