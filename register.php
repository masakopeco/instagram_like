<?php
session_start();
include("./funcs.php");


//入力チェック(受信確認処理追加)
if(
  !isset($_POST["lid"]) || $_POST["lid"]=="" ||
  !isset($_POST["lpw"]) || $_POST["lpw"]=="" ||
  !isset($_POST["lname"]) || $_POST["lname"]==""
){
  exit('ParamError');
}


//1. POSTデータ取得
$lid   = $_POST["lid"];
$lpw  = $_POST["lpw"];
$lname = $_POST["lname"];
$lnaiyou = $_POST["lnaiyou"];

//パスワードハッシュを作成：
$hash = password_hash($lpw, PASSWORD_DEFAULT);


//2. DB接続します(エラー処理追加) try{}catch(){}
$pdo = db_connect();

//３．データ登録SQL作成
$sql = "INSERT INTO gs_user_table(id, user_id, password, user_name, naiyou, indate )VALUES(NULL, :lid, :lpw, :lname, :lnaiyou, sysdate())"; //直接$name, $email, $naiyouだと危険なので一度:a1,:a2,:a3に置き換える
$stmt = $pdo->prepare($sql);//$stmtにセットする
$stmt->bindValue(':lid',   $lid,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw',   $hash,  PDO::PARAM_STR);
$stmt->bindValue(':lname', $lname, PDO::PARAM_STR);
$stmt->bindValue(':lnaiyou', $lnaiyou, PDO::PARAM_STR);
$status = $stmt->execute(); //$stmtを実行

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //５．index.phpへリダイレクト
  $_SESSION["check_ssid"] = session_id();
  $_SESSION["user_name"] = $lname;
  $_SESSION["naiyou"] = $lnaiyou;
  $_SESSION["loginFlg"] = True;

  header("Location: index.php");
  exit;

}
?>
