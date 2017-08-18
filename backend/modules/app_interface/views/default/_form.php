<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\modules\app_interface\models\SourceMessage;

/* @var $this yii\web\View */
/* @var $model common\modules\app_interface\models\SourceMessage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="source-message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if($model->isNewRecord): ?>

        <?= $form->field($model, 'category')->dropDownList(SourceMessage::getModels(), ['prompt' => '', 'maxlength' => true]); ?>

    <?php else: ?>

        <?= $form->field($model, 'category')->dropDownList(SourceMessage::getModels(), ['maxlength' => true]); ?>

    <?php endif; ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6]); ?>

    <?php foreach(Yii::$app->params['languages'] as $langKey => $langValue): ?>
        <div class="box box-solid box-primary">
            <div class="box-header"><?= $langValue ?></div>
            <div class="box-body">
                <?php if($model->isNewRecord): ?>
                    <?= $form->field($messages, "translation[$langKey]")->textarea(['rows' => 6]) ?>
                <?php elseif(key_exists($langKey, $messages)): ?>
                    <?= $form->field($messages[$langKey], "translation[$langKey]")->textarea([
                        'value' => $messages[$langKey]->translation,
                        'rows' => 6
                    ]) ?>
                <?php else: ?>
                     <?= $form->field(new \common\modules\app_interface\models\Message(), "translation[$langKey]")->textarea(['rows' => 6]) ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
