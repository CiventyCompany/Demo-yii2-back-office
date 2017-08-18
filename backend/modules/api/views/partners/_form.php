<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use backend\modules\api\models\PartnerFields;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $partner backend\modules\api\models\Partners */
/* @var $form yii\widgets\ActiveForm */
/* @var $user \backend\modules\user\models\User */
/* @var $fields PartnerFields */
/* @var $profile \backend\modules\user\models\Profile */

$this->registerJs("

new Clipboard('.copyBtn');

$('.copyBtn').click(function(){
    alert('Токен успешно помещён в буфер обмена.');
})
        
");
?>

<div class="partners-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($user, 'username')->textInput(['maxlength' => true])->label('Название Партнёра'); ?>

    <?= $form->field($user, 'role')->hiddenInput(['value' => 'partner'])->label(false); ?>

    <?php if(!$partner->isNewRecord): ?>
        <div class="form-group">
            <label>ACCESS TOKEN</label>
            <div class="input-group">
                <input type="text" id="copyTarget" readonly="readonly" value="<?= $partner->access_token !== '' ? $partner->access_token : 'Заблокирован'; ?>" class="form-control">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-danger ban" data-id="<?= $partner->id; ?>" title="Заблокировать"><span class="glyphicon glyphicon-off"></span></button>
                    <button type="button" class="btn btn-warning regenToken" data-id="<?= $partner->id; ?>" title="Обновить"><span class="glyphicon glyphicon-retweet"></span></button>
                    <button type="button" data-clipboard-target="#copyTarget" class="btn btn-success copyBtn" title="Скопировать"><span class="glyphicon glyphicon-floppy-disk"></span></button>
                </span>
            </div>
            <p class="text text-info" style="float: right">ACCESS TOKEN необходим для доступа партнёра в API нашего сайта. Это уникальное и секретное поле.</p>
        </div>

    <?php endif; ?>

    <?= $form->field($partner, 'description')->textarea(['rows' => 10]); ?>

    <div class="form-group">
        <label>Настройка привелегий</label>
        <?php
            $models = PartnerFields::getTabModels();
            $items = [];
            $i = 1;
            foreach ($models as $model){
                $items[] = [
                    'label'   => Yii::t('app', $model['label']),
                    'content' =>  $this->render($model['view'], [
                        'model'   => $model['model'],
                        'form'    => $form,
                        'partner' => $partner
                    ]),
                    'active' => ($i == 1) ? true : false
                ];
                $i++;
            }
        ?>
        <?= Tabs::widget([
            'items'   => $items
        ]);?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($partner->isNewRecord ? Yii::t('app','Create'): Yii::t('app','Update'), ['class' => $partner->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
