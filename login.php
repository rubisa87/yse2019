<?php
/* 
【機能】
	　ユーザ名とパスワードを元に認証を行う。認証についてはソースコードに
	直接記述されているユーザ名とパスワードが一致しているかを確認する。
	一致していた場合はログインして書籍一覧を表示し、ログインできない
	場合はエラーとする。

【エラー一覧（エラー表示：発生条件）】
	名前かパスワードが未入力です：IDまたはパスワードが未入力
	ユーザー名かパスワードが間違っています：①IDが間違っている　②IDが正しいがパスワードが異なる
	ログインしてください：ログインしていない状態で他のページに遷移した場合(ログイン画面に遷移し上記を表示)
*/
//⑥セッションを開始する
	session_start();

//①名前とパスワードを入れる変数を初期化する
	$db["name"]= "zaiko2019_yse";
	$db["pass"]= "2019zaiko";
	$db["host"]="localhost";
	$db["dbname"]="zaiko2019_yse";
	$errormess="";

/*
 * ②ログインボタンが押されたかを判定する。
 * 押されていた場合はif文の中の処理を行う
 */
if (isset($_POST["decision"])) {
	/*
	 * ③名前とパスワードが両方とも入力されているかを判定する。
	 * 入力されていた場合はif文の中の処理を行う。
	 */
	if (isset($_POST["name"]) and isset($_POST["pass"]) ) {
		//④名前とパスワードにPOSTで送られてきた名前とパスワードを設定する
		$name = $_POST["name"];
		$pass = $_POST["pass"];
	} else {
		//⑤名前かパスワードが入力されていない場合は、「名前かパスワードが未入力です」という文言をメッセージを入れる変数に設定する
	if(!isset($_POST["name"])){
	$errormess =$errormess."ユーザ名未入力です。<br>";
	}
	if(!isset($_POST["pass"])){
	$errormess=$errormess."パスワード未入力です<br>";
	}
	}


	
}


//⑦名前が入力されているか判定する。入力されていた場合はif文の中に入る
if (isset($_POST["name"]) & isset($_POST["pass"])) {
	//⑧名前に「yse」、パスワードに「2019」と設定されているか確認する。設定されていた場合はif文の中に入る
	if (($name==$db["name"]) &($pass==$db["pass"])){
		//⑨SESSIONに名前を設定し、SESSIONの「login」フラグをtrueにする
		//⑩在庫一覧画面へ遷移する
		session_regenerate_id(true);
		header("Location: zaiko_ichiran.php");
		exit();
	}else{
		$errormess=$errormess."ユーザー名かパスワードが間違っています";
		//⑪名前もしくはパスワードが間違っていた場合は、「ユーザー名かパスワードが間違っています」という文言をメッセージを入れる変数に設定する
	}
}

//⑫SESSIONの「error2」に値が入っているか判定する。入っていた場合はif文の中に入る
// if (/* ⑫の処理を書く */) {
	//⑬SESSIONの「error2」の値をエラーメッセージを入れる変数に設定する。
	//⑭SESSIONの「error2」にnullを入れる。
// }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ログイン</title>
<link rel="stylesheet" href="css/login.css" type="text/css" />
</head>
<body id="login">
	<div id="main">
		<h1>ログイン</h1>
		<?php
		//⑮エラーメッセージの変数に入っている値を表示する
		// echo "<div id='error'>", /* ⑮の変数を書く */, "</div>";
		echo $errormess ;
		//⑯メッセージの変数に入っている値を表示する
		// echo "<div id='msg'>", /* ⑯の変数を書く */, "</div>";
		?>
		<form action="login.php" method="post" id="log">
			<p>
				<input type='text' name="name" size='5' placeholder="Username">
			</p>
			<p>
				<input type='password' name='pass' size='5' maxlength='20'
					placeholder="Password">
			</p>
			<p>
				<button type="submit" formmethod="POST" name="decision" value="1"
					id="button">Login</button>
			</p>
		</form>
	</div>
</body>
</html>