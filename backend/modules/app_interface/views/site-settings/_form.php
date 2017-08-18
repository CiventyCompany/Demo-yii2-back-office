<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\app_interface\models\SiteSettings;
use backend\helpers\TypeInputHelper;

/* @var $this yii\web\View */
/* @var $model common\modules\app_interface\models\SiteSettings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="site-settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true, 'disabled' => true]); ?>

    <?php // $form->field($model, 'type')->dropDownList(SiteSettings::getTypesDropDown()); ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]); ?>

    <?php // TypeInputHelper::getTypeInput($form, $model, 'value', $model->isNewRecord ? null : $model->type); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
