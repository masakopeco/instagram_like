<?php
session_start();
include("./funcs.php");

//articleのidを取得し、article_idへ代入
$article_id = $_GET["id"];
//ユーザネームのsessionをlike tableのuser_idに入れる変数へ代入
$user_id = $_SESSION["user_name"];

//DB接続
$pdo = db_connect();
$stmt2 = $pdo->prepare("SELECT COUNT(id) as cnt FROM likes WHERE article_id=:id AND user_id =:user_id");
$stmt2->bindValue(':id', $article_id, PDO::PARAM_INT);
$stmt2->bindValue(":user_id",$user_id,PDO::PARAM_STR);
$stmt2->execute();
$result2 = $stmt2->fetch();
$count = $result2["cnt"];

if($count == 1){
  //いいね済み
  //index.phpへリダイレクト
  header("Location: index.php");
  exit;

}else{

//likes tableにいいね追加
$sql = "INSERT INTO likes (article_id,user_id) VALUES (:article_id,:user_id)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':article_id', $article_id, PDO::PARAM_INT);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$status = $stmt->execute();


//いいね登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //index.phpへリダイレクト
  header("Location: index.php");
  exit;
}

}
 ?>
