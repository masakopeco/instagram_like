<?php

include('./funcs.php');
// DB接続
$pdo = db_connect();

//ページ取得
$limit=9;
if (isset ($_GET['page'])) {
  $page=$_GET['page'];
}

$offset=($page-2)*$limit+$limit;
$stmt = $pdo->prepare("SELECT image FROM gs_an_table ORDER BY indate DESC LIMIT $limit OFFSET $offset");
$status = $stmt->execute();

//４．データ登録処理後
$view = "";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    if($result["image"]){
      if (isset($_SESSION["loginFlg"]) && $_SESSION["loginFlg"]) {
        $view .= '<div class="item">';
        $view .= '<img src="'.$result["image"].'">';
        $view .= '<span class="overlay"><i class="material-icons" id="heart">favorite</i>件</span>';
        $view .= '</div>';
      } else {
        $view .= '<div class="item">';
        $view .= '<img src="'.$result["image"].'">';
        $view .= '</div>';
      }
    }
  }
}

echo $view;
exit;

?>
