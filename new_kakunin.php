<?php

session_start();
/*ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
追加機能に対して、新しいカラム追加しました
カラム名：deleflag 
データ型　Boolean, デフォルト値　False 或いは
データ型　TYNYINT デフォルト値　0 

ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
*/
function new_product($title,$author,$saleDate,$price,$stock){
		$pdo = new PDO("mysql:host=localhost;dbname=zaiko2019_yse;charset=utf8;","zaiko2019", "2019zaiko");
// $sql = "INSERT INTO books(title,author,salesDate,isbn,price,stock,deleflag) VALUES ($title,$author,$saleDate,$aa,$price,$stock,$aa)";
		$a= $pdo->prepare("INSERT INTO books(title,author,salesDate,isbn,price,stock,deleflag) VALUES (?,?,?,?,?,?,?)");
		 return $result=$a->execute(array($title,$author,$saleDate,0,$price,$stock,0));
	// $sql = "INSERT INTO books(title,author,saleDate,price,stock) VALUES (?,?,?,?,?)";
	// 	 $a = $con->prepare($sql);
	// 	 return $result= $a->execute(array($title,$author,$saleDate,$price,$stock));

	//③実行した結果から1レコード取得し、returnで値を返す。
}



if ($_SESSION["login"] ==False){
	//④SESSIONの「error2」に「ログインしてください」と設定する。
	$_SESSION['error2'] ="ログインしてください";
	header("Location: login.php");//④ログイン画面へ遷移する。
}

// $con = mysqli_connect("localhost" , "zaiko2019" , "2019zaiko" , "zaiko2019_yse");
	// mysqli_set_charset($con,"UTF8");
	// $con = new PDO("mysql:dbname=b13_24945452_seisaku;host=sql304.byethost.com;charset=utf8", "b13_24945452","NFky0561");


if(@$_POST['new']=="ok"/* ㉓の処理を書く */){
$result;
$stock=$_POST['stock']+$_POST['nyuka'];
echo "truoc khi goi result:check VALUES".$_POST['title'].$_POST['author'].$_POST['saleDate'].$_POST['price'].$stock."<br>";
		$result=new_product($_POST['title'],$_POST['author'],$_POST['saleDate'],$_POST['price'],$stock);
if($result){
	$_SESSION['success'] ="新商品が追加しました";
	header("Location: zaiko_ichiran.php");//④ログイン画面へ遷移する。
}
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>新商品追加</title>
<link rel="stylesheet" href="css/ichiran.css" type="text/css" />
</head>
<body>
<div id="header">
	<h1>新商品追加</h1>
</div>
<form action="new_kakunin.php" method="post" id="test">
	<div id="pagebody">
		<div id="center">
			<table>
				<thead>
					<tr>
						<th id="id">ID</th>
						<th id="book_name">書籍名</th>
						<th id="author">著者名</th>
						<th id="salesDate">発売日</th>
						<th id="itemPrice">金額</th>
						<th id="stock">在庫数</th>
						<th id="stock">入荷数</th>

					</tr>
				</thead>
				<tbody>
				
					<tr>
						<td><?php echo	$_POST['ID']/* ㉟ ㉞で取得した書籍情報からtitleを表示する。 */;?></td>
						<td><?php echo	$_POST['title']/* ㉟ ㉞で取得した書籍情報からtitleを表示する。 */;?></td>
						<td><?php echo	$_POST['author']/* ㊱ ㉞で取得した書籍情報からstockを表示する。 */;?>
						<td><?php echo	$_POST['saleDate']/* ㊱ ㉞で取得した書籍情報からstockを表示する。 */;?>
						<td><?php echo	$_POST['price']/* ㊱ ㉞で取得した書籍情報からstockを表示する。 */;?>
						<td><?php echo	$_POST['stock']/* ㊱ ㉞で取得した書籍情報からstockを表示する。 */;?>
						<td><?php echo	$_POST['nyuka']/* ㊱ ㉞で取得した書籍情報からstockを表示する。 */;?>

						</td>

					</tr>
					<input type="hidden" name="ID" value="<?php echo $_POST['ID']/* ㊳ ㉝で取得した値を設定する */;?>">
					<input type="hidden" name="title" value="<?php echo $_POST['title']/* ㊳ ㉝で取得した値を設定する */;?>">
					<input type="hidden" name="author" value="<?php echo $_POST['author']/* ㊳ ㉝で取得した値を設定する */;?>">
					<input type="hidden" name="saleDate" value="<?php echo $_POST['saleDate']/* ㊳ ㉝で取得した値を設定する */;?>">
					<input type="hidden" name="price" value="<?php echo $_POST['price']/* ㊳ ㉝で取得した値を設定する */;?>">
					<input type="hidden" name="stock" value="<?php echo $_POST['stock']/* ㊳ ㉝で取得した値を設定する */;?>">
					<input type="hidden" name="nyuka" value="<?php echo $_POST['nyuka']/* ㊳ ㉝で取得した値を設定する */;?>">

				</tbody>
			</table>
			<div id="kakunin">
				<p>
					上記の書籍を削除します。<br>
					よろしいですか？
				</p>
				<button type="submit" id="message" formmethod="POST" name="new" value="ok">はい</button>
				<button type="submit" id="message"  formmethod="POST" name="new" value="stop"　formaction="new_product.php">いいえ</button>
			</div>
		</div>
	</div>
</form>
<div id="footer">
	<footer>株式会社アクロイト</footer>
</div>
</body>
</html>
