<?php
// 自撮り写真をデータベースに登録する

session_start();
include('./funcs.php');

$name = $_SESSION["user_name"];
$src = $_POST["limage"];

//2. DB接続
$pdo = db_connect();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_myphoto_table(id, name, image, indate)VALUES(NULL, :name, :image, sysdate())");
$stmt->bindValue(':name', $name,   PDO::PARAM_STR);
$stmt->bindValue(':image', $src, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //５．index.phpへリダイレクト
  header("Location: mypage.php");//エラーでなければ〜を表示する。
  exit;
}
?>
