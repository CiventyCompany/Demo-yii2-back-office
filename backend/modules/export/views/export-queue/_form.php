<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \backend\modules\export\models\ExportQueue */
/* @var $form yii\widgets\ActiveForm */

\kartik\date\DatePickerAsset::register($this);
//\kartik\datetime\DateTimePickerAsset::register( $this );
?>

<div class="export-queue-form">

    <?php $form = ActiveForm::begin([

    ]); ?>

    <?= $form->field($model, 'model')->dropDownList( $model::getModels(), ['prompt' => Yii::t('app', 'Select model')] ) ?>

    <div id="model-settings"></div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
