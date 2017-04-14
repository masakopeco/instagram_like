<?php
session_start();
include('./funcs.php');

// DB接続
$pdo = db_connect();

//３．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_an_table ORDER BY indate DESC LIMIT 9");
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

      //いいね数表示のためのSQL
      $stmt2 = $pdo->prepare("SELECT COUNT(id) as cnt FROM likes WHERE article_id=:id");
      $stmt2->bindValue(":id",$result["id"],PDO::PARAM_INT);
      $stmt2->execute();
      $result2 = $stmt2->fetch();
      $like_count = $result2["cnt"];

      if (isset($_SESSION["loginFlg"]) && $_SESSION["loginFlg"]) {
        $view .= '<div class="item">';
        $view .= '<img src="'.$result["image"].'">';
        $view .= '<span class="overlay"><a href="likes.php?id='.$result["id"].'"><i class="material-icons" id="heart">favorite</i></a>';
        $view .= $like_count.'件</span>';
        $view .= '</div>';
      } else {
        $view .= '<div class="item">';
        $view .= '<img src="'.$result["image"].'">';
        $view .= '</div>';
      }
    }
  }
}
?>

<main>
  <div class="wrapper" id="photos">
    <?=$view?>
  </div>
  <div class="loadbtn-wrapper">
    <button type="button" name="button" id="load_product">more photos</button>
  </div>
  <!-- <a href="#top" id="totop"><i class="material-icons">keyboard_arrow_up</i></a> -->
</main>
