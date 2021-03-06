<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\common\models\ReferenceBookValues */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reference-book-values-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reference_book_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true, 'autofocus' => 'autofocus']) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
