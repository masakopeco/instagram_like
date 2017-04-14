<?php
session_start();
include("./funcs.php");


//1.ユーザネームを取得
$user_name = $_SESSION["user_name"];

//2.DB接続
$pdo = db_connect();

//3.ユーザネームが一致する人のデータを表示する
$sql = 'SELECT * FROM gs_an_table WHERE name=:user_name ORDER BY indate DESC ';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$status = $stmt->execute();

//4.データ表示
$view="";
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    if($result["image"]){
      $view .= '<div class="item">';
      $view .= '<img src="'.$result["image"].'">';
      $view .= '<ul class="overlay"><li>';
      $view .= '<a href="delete.php?id='.$result["id"].'">';
      $view .= '<span class="delete">✕</span>';
      $view .= '</a>';
      $view .= '</li></ul>';
      $view .= '</div>';
    }
  }
}

// 自撮り写真をDBから取得する
$sql2 = 'SELECT image FROM gs_myphoto_table WHERE name=:user_name ORDER BY indate DESC LIMIT 1';
$stmt2 = $pdo->prepare($sql2);
$stmt2->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$status2 = $stmt2->execute();

//4.データ表示
$view2="";
if($status2==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error2 = $stmt2->errorInfo();
  exit("QueryError:".$error2[2]);

}else{
  while($result2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
    if($result2["image"]){
      $view2 .= '<div class="myphoto-image">';
      $view2 .= '<img id="img" src="'.$result2["image"].'">';
      $view2 .= '</div>';
    }
  }
}

$sql3 = 'SELECT count(image) FROM gs_an_table WHERE name=:user_name';
$stmt3 = $pdo->prepare($sql3);
$stmt3->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$status3 = $stmt3->execute();

$view3="";
if($status3==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error3 = $stmt3->errorInfo();
  exit("QueryError:".$error3[2]);
}else{
  while($result3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
    if($result3["count(image)"]){
      $view3 = $result3["count(image)"];
    } else {
      $view3 = "0";
    }
  }
}


?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.5/css/uikit.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.5/js/uikit.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="header_logout.js"></script>
    <script type="text/javascript" src="style_mypage.js"></script>
    <script type="text/javascript" src="camera.js"></script>
    <link rel="stylesheet" type="text/css" href="index.css">
    <link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
    <meta name="viewport" content="width=device-width">
    <title>Instagran</title>
  </head>
  <body id="body_mypage">
    <header>
        <nav class="uk-navbar-container" uk-navbar>
          <i class="material-icons" id="title_icon">photo_camera</i>
          <h1 class="nav-h1" id="title_text">Instagran</h1>
          <!-- <form class="uk-search uk-search-default search-form">
            <span uk-search-icon class="search-icon"></span>
            <input class="uk-search-input" type="search" placeholder="Search...">
          </form> -->
          <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
              <?if (isset($_SESSION["loginFlg"]) && $_SESSION["loginFlg"]){?>
                <li><a class="uk-button uk-button-default" href="#modal-photo02" uk-toggle>写真を投稿</a></li>
                <li><a id="logout-btn" class="uk-button uk-button-default" href="logout.php" uk-toggle>ログアウト</a></li>
              <?}else{?>
                <li><a class="uk-button uk-button-default" href="#modal-new" uk-toggle>新規登録</a></li>
                <li><a class="uk-button uk-button-default" href="#modal-sections" uk-toggle>ログイン</a></li>
              <?}?>
            </ul>
          </div>
        </nav>
          <!-- <a class="uk-button uk-button-default" href="#modal-sections" uk-toggle>Login</a> -->
    </header>

    <?php include('./include_modal.html'); ?>
    <?php include('./include_modal_photo02.php'); ?>
    <?php include('./include_modal_myphoto.php'); ?>
    <?php include('./include_modal_new.php'); ?>
    <?php include('./include_footer.html'); ?>

<!-- class="uk-button uk-button-default" -->
    <main class="mypage-main">
      <div class="mypageIntro">
        <?if(!isset($view2) || $view2==""){?>
          <button type="button" name="button" href="#modal-myphoto" uk-toggle class="selfie-button">自分の写真を<br />撮る</button>
        <?}else{?>
          <?=$view2?>
        <?}?>
        <div class="intro-wrapper">
          <h2 id="mypage-title"><?=$_SESSION["user_name"]?></h2>
          <p class="photo-count">投稿 <?=$view3?> 件</p>
          <p><?=$_SESSION["naiyou"]?></p>
        </div>
      </div>
      <div class="wrapper">
        <?if(!isset($view) || $view==""){?>
          <p class="nophoto-message">右上の「写真を投稿」ボタンから、写真を投稿してみましょう♪</p>
        <?}else{?>
          <?=$view?>
        <?}?>
      </div>
      <!-- <div id="load_product">More Photos</div> -->
      <a href="#top" id="totop"><i class="material-icons">keyboard_arrow_up</i></a>
    </main>
  </body>
</html>
