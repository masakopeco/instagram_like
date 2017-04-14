<div id="modal-myphoto" uk-modal="center: true">
  <div class="uk-modal-dialog">
      <button class="uk-modal-close-default" type="button" uk-close></button>
      <div class="uk-modal-header">
          <h2 class="modalform-title-photo">Take a selfie</h2>
      </div>
      <div class="uk-modal-body">
          <div class="uk-margin">
            <div class="myphoto">
              <div class="videowrapper">
                <h2 class="selfie-style">Video <button type="button" name="button" id="start">撮影する</button></h2>
              	<video id="camera" autoplay></video>
              	<canvas id="canvas"></canvas>
              </div>
              <i class="material-icons arrow-icon">forward</i>
              <div class="imagewrapper">
                <h2 class="selfie-style">Image</h2>
              	<img id="img">
              </div>
            </div>
          </div>
          <div class="uk-modal-footer uk-text-center">
            <form action="insertMyphoto.php" method="POST" name='form' enctype="multipart/form-data" class="uk-form-horizontal uk-margin-large">
              <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
              <input id='mypic' type="hidden" name="limage" accept='image/*'>
              <input type="submit" class="uk-button uk-button-primary" value="写真を保存">
            </form>
          </div>
      </div>
    </div>
</div>
