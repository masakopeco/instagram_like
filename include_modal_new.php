<div id="modal-full" class="uk-modal-full" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-full" type="button" uk-close></button>
        <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
            <div class="uk-background-cover" style="background-image: url('https://www.pakutaso.com/shared/img/thumb/CAT9V9A9145_TP_V.jpg');" uk-height-viewport></div>
            <div class="uk-padding-large">
                <h1 class="modalform-title">Welcome to <span class="modalform-title-main">Instagran</span></h1>
                <form action="register.php" method="post" class="uk-form-horizontal uk-margin-large">
                  <div class="uk-margin">
                      <label class="uk-form-label form-text" for="form-horizontal-text">ユーザーネーム</label>
                      <div class="uk-form-controls">
                          <input class="uk-input form-input" id="form-horizontal-text" type="text" name="lname" placeholder="任意のユーザーネーム">
                      </div>
                  </div>
                  <div class="uk-margin">
                      <label class="uk-form-label form-text" for="form-horizontal-text">ID</label>
                      <div class="uk-form-controls">
                          <input class="uk-input form-input" id="form-horizontal-text" type="text" name="lid" placeholder="任意のID">
                      </div>
                  </div>
                  <div class="uk-margin">
                      <label class="uk-form-label form-text" for="form-horizontal-text">Password</label>
                      <div class="uk-form-controls">
                          <input class="uk-input form-input" id="form-horizontal-text" type="password" name="lpw" placeholder="半角英数8文字以内">
                      </div>
                  </div>
                  <div class="uk-margin">
                      <label class="uk-form-label form-text" for="form-horizontal-text">自己紹介</label>
                      <div class="uk-form-controls">
                          <textarea class="input-textarea" id="form-horizontal-text" name="lnaiyou" rows="4" cols="38"></textarea>
                      </div>
                  </div>
                  <div class="button-wrapper">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                    <input type="submit" class="uk-button uk-button-primary" value="登録">
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
