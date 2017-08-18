<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\app_interface\models\Notifications;

/* @var $this yii\web\View */
/* @var $model common\modules\app_interface\models\Notifications */
/* @var $form yii\widgets\ActiveForm */
?>
<div id="notificationId" data-id="<?= $model->notification_id; ?>" data-mark="<?= $model->mark; ?>"></div>

<div class="notifications-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'entity')->textInput(['maxlength' => true, 'disabled' => true]) ?>

    <?= $form->field($model, 'key')->dropDownList(Notifications::getKeysDropDown()); ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'mark')->dropDownList(Notifications::getMarksDropDown()); ?>

    <?= $form->field($model, 'created_at')->textInput(['disabled'=>true]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
