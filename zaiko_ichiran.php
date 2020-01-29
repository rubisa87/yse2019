<?php
/* 
【機能】
書籍テーブルより書籍情報を取得し、画面に表示する。
商品をチェックし、ボタンを押すことで入荷、出荷が行える。
ログアウトボタン押下時に、セッション情報を削除しログイン画面に遷移する。

【エラー一覧（エラー表示：発生条件）】
入荷する商品が選択されていません：商品が一つも選択されていない状態で入荷ボタンを押す
出荷する商品が選択されていません：商品が一つも選択されていない状態で出荷ボタンを押す
*/

//①セッションを開始する
	session_start();
	$db['host']="localhost";
	$db['dbname']="zaiko2019_yse";
	$db['username']= "zaiko2019_yse";
	$db['pass']= "2019zaiko";


//②SESSIONの「login」フラグがfalseか判定する。「login」フラグがfalseの場合はif文の中に入る。
// if (/* ②の処理を書く */){
if ($_SESSION['login']==False){
	//③SESSIONの「error2」に「ログインしてください」と設定する。
	//④ログイン画面へ遷移する。
// }
	$_SESSION['error2'] ="ログインしてください";
	header("Location: login.php");//④ログイン画面へ遷移する。
}

//⑤データベースへ接続し、接続情報を変数に保存する

//
//⑦書籍テーブル⑥データベースで使用する文字コードを「UTF8」にするから書籍情報を取得するSQLを実行する。また実行結果を変数に保存する

//⑦書籍テーブルから書籍情報を取得するSQLを実行する。また実行結果を変数に保存する
  // $pdo = new PDO("mysql:host=$db['host'];dbname=$db['dbname'];charset=utf8;",$db['username'], $db['pass'] );
 // $hostname="172.16.23.13:3306";
 $hostname="localhost";
  $pdo = new PDO("mysql:host=$hostname;dbname=zaiko2019_yse;charset=utf8;","zaiko2019", "2019zaiko" );
    $st = $pdo->query("SELECT * FROM books ");
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>書籍一覧</title>
	<link rel="stylesheet" href="css/ichiran.css" type="text/css" />
</head>
<body>
	<div id="header">
		<h1>書籍一覧</h1>
	</div>
	<form action="zaiko_ichiran.php" method="post" id="myform" name="myform">
		<div id="pagebody">
			<!-- エラーメッセージ表示 -->
			<div id="error">
				<?php
				/*
				 * ⑧SESSIONの「success」にメッセージが設定されているかを判定する。
				 * 設定されていた場合はif文の中に入る。
				 */ 
								// echo $_SESSION["success"];

				if(@($_SESSION["success"])){
					//⑨SESSIONの「success」の中身を表示する。
				echo $_SESSION["success"];
				}
				?>
			</div>
			
			<!-- 左メニュー -->
			<div id="left">
				<p id="ninsyou_ippan">
					<?php
						echo @$_SESSION["account_name"];
						echo @$_SESSION["NAME"];
					?><br>
					<button type="button" id="logout" onclick="location.href='logout.php'">ログアウト</button>
				</p>
				<button type="submit" id="btn1" formmethod="POST" name="decision" value="3" formaction="nyuka.php">入荷</button>

				<button type="submit" id="btn1" formmethod="POST" name="decision" value="4" formaction="syukka.php">出荷</button>

				<button type="submit" id="btn1" formmethod="POST" name="decision" value="5" formaction="new_product.php">新商品追加</button>
				<button type="submit" id="btn1" formmethod="POST" name="decision" value="6" formaction="delete_prpduct.php">商品削除</button>

			</div>
			<!-- 中央表示 -->
			<div id="center">

				<!-- 書籍一覧の表示 -->
				<table>
					<thead>
						<tr>
							<th id="check"></th>
							<th id="id">ID</th>
							<th id="book_name">書籍名</th>
							<th id="author">著者名</th>
							<th id="salesDate">発売日</th>
							<th id="itemPrice">金額</th>
							<th id="stock">在庫数</th>
						</tr>
					</thead>
					<tbody>
						<?php
						//⑩SQLの実行結果の変数から1レコードのデータを取り出す。レコードがない場合はループを終了する。
						while($extract=$st->fetch()){
							// ⑪extract変数を使用し、1レコードのデータを渡す。

							// echo "<tr id='book'>";
							// echo "<td id='check'><input type='checkbox' name='books[]'value="./* ⑫IDを設定する */."></td>";
							// echo "<td id='id'>/* ⑬IDを表示する */</td>";
							// echo "<td id='title'>/* ⑭titleを表示する */</td>";
							// echo "<td id='author'>/* ⑮authorを表示する */</td>";
							// echo "<td id='date'>/* ⑯salesDateを表示する */</td>";
							// echo "<td id='price'>/* ⑰priceを表示する */</td>";
							// echo "<td id='stock'>/* ⑱stockを表示する */</td>";
							// echo "</tr>";

							echo "<tr id='book'>";
							echo "<td id='check'><input type='checkbox' name='books[]'value=".$extract['id']."></td>";
							echo "<td id='id'>".$extract['id']."</td>";
							echo "<td id='title'>".$extract['title']."</td>";
							echo "<td id='author'>".$extract['author']."</td>";
							echo "<td id='date'>".$extract['salesDate']."</td>";
							echo "<td id='price'>".$extract['price']."</td>";
							echo "<td id='stock'>".$extract['stock']."</td>";

							echo "</tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</form>
	<div id="footer">
		<footer>株式会社アクロイト</footer>
	</div>
</body>
</html>
