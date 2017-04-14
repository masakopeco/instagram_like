<?php
session_start();
include("./funcs.php");

//1.GETでidを取得
$id = $_GET["id"];

//2.DB接続
$pdo = db_connect();

//データベースから登録した写真（image)をdeleteする
$sql = 'DELETE FROM gs_an_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);    //更新したいidを渡す
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //select.phpへリダイレクト
  header("Location: mypage.php");
  exit;

}

?>
