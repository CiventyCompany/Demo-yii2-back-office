<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\credit_product\models\CreditProductWidget */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="credit-product-widget-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tab_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->widget(\mihaildev\ckeditor\CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'full',
            'inline' => false,
            'height' => 250
        ],
    ]);  ?>

    <?= $form->field($model, 'min')->input('number') ?>

    <?= $form->field($model, 'max')->input('number') ?>

    <?= $form->field($model, 'sort')->input('number', ['value' => $model->isNewRecord ? 0 : $model->sort]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
