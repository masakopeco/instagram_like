<?php
//〜〜File upload用のファイル〜〜

//1.アップロードが正常に行われたかチェック
//isset();でファイルが送られてきてるかチェック！そしてErrorが発生してないかチェック
session_start();
include('./funcs.php');

$name = $_SESSION["user_name"];

if(isset($_FILES['file']) && $_FILES['file']['error']==0){
    //***File名の変更***
    $file_name = $_FILES["file"]["name"]; //"1.jpg"ファイル名取得
    $extension = pathinfo($file_name, PATHINFO_EXTENSION); //拡張子取得
    $uniq_name = date("YmdHis").md5(session_id()) . "." . $extension;  //ユニークファイル名作成

    $org_file = $_FILES["file"]["tmp_name"]; // 元画像ファイル
    $upload_file = "./upload/".$uniq_name; // 画像保存先のパス
    $image_type = exif_imagetype($org_file); // 画像タイプ判定用

    // 元画像ファイル読み込み
    switch($image_type){
      case IMAGETYPE_GIF:
        $srcImage = imagecreatefromgif($org_file);
        break;
      case IMAGETYPE_JPEG:
        $srcImage = imagecreatefromjpeg($org_file);
        break;
      case IMAGETYPE_PNG:
        $srcImage = imagecreatefrompng($org_file);
        break;
    }
    // $in = ImageCreateFromJPEG($org_file); // 元画像ファイル読み込み
    $width = ImageSx($srcImage); // 画像の幅を取得
    $height = ImageSy($srcImage); // 画像の高さを取得
    $min_width = 300; // 幅の最低サイズ
    $min_height = 300; // 高さの最低サイズ

    if ($image_type == IMAGETYPE_JPEG | $image_type == IMAGETYPE_GIF | $image_type == IMAGETYPE_PNG){
          if($width >= $min_width|$height >= $min_height){
            $new_width = 293;
            $new_height = 293;
            //画像生成
            $out = ImageCreateTrueColor($new_width , $new_height);//イメージを新規に作成する
            ImageCopyResampled($out, $srcImage, 0,0,0,0, $new_width, $new_height, $width, $height);//画像の拡大縮小

            //画像をファイルに出力
            $upload_flg;
            if($image_type == IMAGETYPE_JPEG){
              $upload_flg = Imagejpeg($out, $upload_file);
            }else if($image_type == IMAGETYPE_GIF){
              $upload_flg = Imagegif($out, $upload_file);
            }else if($image_type == IMAGETYPE_PNG){
              $upload_flg = Imagepng($out, $upload_file);
            }
            // var_dump($upload_flg);
            // echo dirname(__FILE__);
            // /Applications/XAMPP/xamppfiles/htdocs/gs_code/teamassignment
            // exit;
            // アップロード成功したら文字と画像を表示
            // echo 'アップロード成功';
            // echo '<img src="'.$upload_file.'">';
        } else {
            echo "サイズが幅".$min_width."×高さ".$min_height."以上の画像をご用意ください";
        }
    } else {
        echo "jpg/gif/png only!";
    }
}else{
    echo "fileupload失敗";
}


//2. DB接続します(エラー処理追加)
//DB接続
$pdo = db_connect();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_an_table(id, name, image, indate)VALUES(NULL,:name, :image, sysdate())");
$stmt->bindValue(':name', $name,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':image', $upload_file, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");//エラーでなければ〜を表示する。
  exit;

}
?>
