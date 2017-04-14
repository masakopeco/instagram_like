<?php
//必ずsession_startは最初に記述
session_start();

//SESSIONを初期化(空っぽにする)
$_SESSION = array();

//Cookieに保存してあるsessionIDの保存期間を過去にして破棄
//session_name関数は、セッションID名を返す関数
if (isset($_COOKIE[session_name()])) {
  setcookie(session_name(), '', time()-42000, '/');
}

//サーバー側でのセッションIDの破棄
session_destroy();

//処理後、login.phpにリダイレクト
header("Location: index.php");
exit();

?>
