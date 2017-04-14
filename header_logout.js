$(function(){
  $("#logout-btn").on('click', function(){
    console.log("heyhey");
    UIkit.notification({
      message: 'my-message!',
      status: 'primary',
      pos: 'top-right',
      timeout: 5000
    });
  });
});
