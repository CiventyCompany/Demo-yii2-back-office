<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use backend\modules\social\models\SocialShareTemplates;
?>

<?php $form = ActiveForm::begin() ?>

<?= $form->field($model, 'url')->textInput(); ?>

<?= $form->field($model, 'message')->textInput(); ?>

<?= $form->field($model, 'time')->input('number', ['value' => $model->settings->waiting_time]); ?>

<?= $form->field($model, 'is_active')->dropDownList(SocialShareTemplates::getStatusArray()); ?>

<?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']); ?>

<?php ActiveForm::end(); ?>
