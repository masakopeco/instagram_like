<div id="modal-photo" uk-modal="center: true">
  <div class="uk-modal-dialog">
      <button class="uk-modal-close-default" type="button" uk-close></button>
      <div class="uk-modal-header">
          <h2 class="modalform-title-photo">写真を投稿</h2>
      </div>
      <div class="uk-modal-body">
        <form action="insert.php" method="POST" enctype="multipart/form-data" class="uk-form-horizontal uk-margin-large">
          <div class="uk-margin">
            <input class="uk-input" type="file" accept="image/*" name="file">
          </div>
          <div class="button-wrapper">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <input type="submit" class="uk-button uk-button-primary" value="写真を投稿">
          </div>
        </form>
      </div>
    </div>
</div>

<!-- id="form-horizontal-text" -->
