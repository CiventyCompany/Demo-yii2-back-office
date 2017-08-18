<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\credit_product\models\CreditProductCategoryGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="credit-product-category-group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'credit_product_type_id')->dropDownList( \yii\helpers\ArrayHelper::map($model->getTypes(), 'id', 'title') ) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort')->input('number', ['value' => $model->isNewRecord ? 0 : $model->sort]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList( $model->getAvailableStatuses(false), ['value' => $model->isNewRecord ? 0 : $model->status] ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
