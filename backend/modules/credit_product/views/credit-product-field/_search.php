<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\credit_product\models\search\CreditProductFieldSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="credit-product-field-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'credit_product_type_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'suffix') ?>

    <?= $form->field($model, 'show_in') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'multiple') ?>

    <?php // echo $form->field($model, 'multiple_count') ?>

    <?php // echo $form->field($model, 'show_place') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'alias') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
