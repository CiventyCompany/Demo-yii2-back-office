<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\credit_rating\models\CreditRatingLineSettings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="credit-rating-line-settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'min')->textInput() ?>

    <?= $form->field($model, 'max')->textInput() ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'color')->widget(\kartik\color\ColorInput::classname(), [
        'options' => ['placeholder' => Yii::t('app', 'Select color ...')],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
