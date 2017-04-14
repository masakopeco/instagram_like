$(function(){
  $("#title_icon, #title_text").on('click', function(){
    location.href = 'index.php';
  });

  $("#title_icon, #title_text").hover(function(){
    $(this).css('cursor','pointer');
  });

  var topBtn = $('#totop');
  topBtn.hide();
  //スクロールが100に達したらボタン表示
  $(window).scroll(function () {
      if ($(this).scrollTop() > 30) {
          topBtn.fadeIn();
      } else {
          topBtn.fadeOut();
      }
  });
  //スクロールしてトップ
  topBtn.click(function () {
      $('body,html').animate({
          scrollTop: 0
      }, 500);
      return false;
  });

});
