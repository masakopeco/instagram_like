<?php
//1. POSTでデータを受け取る
//SESSION変数を使う
session_start();
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];

//2. DB接続する(エラー処理追加)
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
  //rootはDBのID、その次はパスワード(XAMPPでは、IDがroot、passwordが無しとなっている)
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//3. データ登録SQL作成
//$nameなどの代わりに、:a1といった変数を置いておく
$sql = "SELECT * FROM gs_user_table WHERE user_id=:lid";// AND password=:lpw
//PDOの中のprepare関数に$sqlを渡し、それを$stmtで保持
$stmt = $pdo->prepare($sql);
//$stmtの中のbindValue関数で、:a1に$nameを関連付ける、と指定
//変な文字が$nameなどに入っていても、自動で無効化するために、変数に入れる
//文字列の場合は、POD::PARAM_STRと書き、数値の場合は、POD::PARAM_INTと書く
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
// $stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
//$stmtの中のexecute関数で、「実行」
//実行すると、$stmtに情報が入る
//$statusの中に、エラーなどの実行結果が入る
$status = $stmt->execute();

//4. データ登録処理後
if ($status==false) {
  //SQL実行時にエラーがある場合(エラーオブジェクトを取得して表示)
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}

//5. データ数を取得
$val = $stmt->fetch();  //1レコードだけ取得する方法

  $_SESSION["loginFlg"] = false;

//6. パスワードがハッシュにマッチするかどうかを調べる
if(password_verify($lpw, $val["password"])){
  $_SESSION["check_ssid"] = session_id();
  $_SESSION["user_name"] = $val["user_name"];
  $_SESSION["naiyou"] = $val["naiyou"];
  $_SESSION["loginFlg"] = true;
  //Login処理OKの場合、index.phpへ遷移
  header("Location: index.php");
}else{
  //Login処理NGの場合、index.phpへ遷移
  header("Location: index.php");
}

//処理終了
exit();

?>
