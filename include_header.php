<?session_start();?>
<header>
    <nav class="uk-navbar-container" uk-navbar>
      <i class="material-icons camera" id="title_icon">photo_camera</i>
      <h1 class="nav-h1">Instagran</h1>
      <form class="uk-search uk-search-default search-form">
        <span uk-search-icon class="search-icon"></span>
        <input class="uk-search-input" type="search" placeholder="Search...">
      </form>
      <div class="uk-navbar-right">
        <ul class="uk-navbar-nav">
          <?if (isset($_SESSION["loginFlg"]) && $_SESSION["loginFlg"]){?>
            <li class="welcome-message">Welcome <?=$_SESSION["user_name"]?> !</li>
            <li><a class="uk-button uk-button-default" href="mypage.php" uk-toggle>MyPage</a></li>
            <li><a class="uk-button uk-button-default" href="#modal-photo" uk-toggle>写真を投稿</a></li>
            <li><a id="logout-btn" class="uk-button uk-button-default" href="logout.php" uk-toggle>ログアウト</a></li>
          <?}else{?>
            <li><a class="uk-button uk-button-default" href="#modal-full" uk-toggle>新規登録</a></li>
            <li><a class="uk-button uk-button-default" href="#modal-sections" uk-toggle>ログイン</a></li>
          <?}?>
        </ul>
      </div>
    </nav>
      <!-- <a class="uk-button uk-button-default" href="#modal-sections" uk-toggle>Login</a> -->
</header>
