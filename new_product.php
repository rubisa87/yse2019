<?php

if (session_status()==PHP_SESSION_NONE) {
	session_start();
	$_SESSION["success"]="";
}


//③SESSIONの「login」フラグがfalseか判定する。「login」フラグがfalseの場合はif文の中に入る。
if ($_SESSION["login"] ==False){
	//④SESSIONの「error2」に「ログインしてください」と設定する。
	$_SESSION['error2'] ="ログインしてください";
	header("Location: login.php");//④ログイン画面へ遷移する。
}

 $pdo = new PDO("mysql:host=localhost;dbname=zaiko2019_yse;charset=utf8;","zaiko2019", "2019zaiko" );
    $st = $pdo->query("SELECT * FROM books ");

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>新商品追加</title>
	<link rel="stylesheet" href="css/ichiran.css" type="text/css" />
</head>
<body>
	<!-- ヘッダ -->
	<div id="header">
		<h1>新商品追加</h1>
	</div>

	<!-- メニュー -->
	<div id="menu">
		<nav>
			<ul>
				<li><a href="zaiko_ichiran.php?page=1">書籍一覧</a></li>
			</ul>
		</nav>
	</div>

	<form action="new_kakunin.php" method="post">
		<div id="pagebody">
			<!-- エラーメッセージ -->
			<div id="error">
			<?php
			/*
			 * ⑬SESSIONの「error」にメッセージが設定されているかを判定する。
			 * 設定されていた場合はif文の中に入る。
			 */ 
			if(@$_SESSION["error"]){
			//⑭SESSIONの「error」の中身を表示する。
			echo $_SESSION["error"];
		}
			?>
			</div>
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
						<?php
						//⑩SQLの実行結果の変数から1レコードのデータを取り出す。レコードがない場合はループを終了する。
						while($extract=$st->fetch()){
							$maxid=$extract['id'];
						}

						$newid=$maxid+1;
						?>
						<tr>
						<td><?php echo $newid  ?></td>
						<td><input type='text' name='title' size='20' maxlength='11' required></td>
						<td><input type='text' name='author' size='20' maxlength='11' required></td>
						<td><input type='date' name='saleDate' size='10' maxlength='11' required></td>
						<td><input type='text' name='price' size='10' maxlength='11' required></td>
						<td><input type='text' name='stock' size='10' maxlength='11' required></td>
						<td><input type='text' name='nyuka' size='10' maxlength='11' required></td>

						</tr>
					</tbody>
				</table>
				<button type="submit" id="kakutei" formmethod="POST" name="decision" value="1">確定</button>
			</div>
		</div>
	</form>
	<!-- フッター -->
	<div id="footer">
		<footer>株式会社アクロイト</footer>
	</div>
</body>
</html>
