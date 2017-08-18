<div class="password-form">
<h3><?= Yii::t('app', 'Change user password'); ?></h3>
    <p class="text text-info"><?= Yii::t('app', 'If you change password, user can\'t login.'); ?></p>
    <form id="changePassForm" data-userId="<?= Yii::$app->request->get('id'); ?>">
        <div class="form-group">
            <label><?= Yii::t('app', 'New password'); ?></label>
            <input type="text" name="newPass" id="newPass" minlength="8" maxlength="16" required=required class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-warning"><?= Yii::t('app', 'Change password'); ?></button>
        </div>
    </form>
</div>
