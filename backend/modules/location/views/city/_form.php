<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model \common\modules\location\models\City */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'country_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'region_id')->dropDownList( $model->getRegions() ) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'orderby')->input('number') ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->input('number') ?>

    <?= $form->field($model, 'people')->input('number') ?>

    <?= $form->field($model, 'oldid')->input('number') ?>

    <?= $form->field($model, 'bold')->input('number') ?>

    <?= $form->field($model, 'k_price')->textInput() ?>

    <?= $form->field($model, 'is_regional_center')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['/location/city/index'], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
