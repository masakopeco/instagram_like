$(function() {
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

    var page = 2;
    $('#load_product').on('click', function(){
  		$.get('load.php',{ page: page }, successfunc);
    });
    function successfunc(result){
    	$(result).appendTo("#photos");
    	page = page + 1;
      $('#load_product').css('display', 'none');
      $('#pagebody').css('height', '1800px');
    }
});
