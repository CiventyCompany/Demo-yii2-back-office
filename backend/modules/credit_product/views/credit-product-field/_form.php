<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\credit_product\models\CreditProductField */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="credit-product-field-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'suffix')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'default_suffix_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList( $model->getAvailableTypes() ) ?>

    <?= $form->field($model, 'credit_product_field_reference_id', [
        'options' => [
            'class' => (!$model->isNewRecord && $model->type == 'reference') ? '' : 'hidden'
        ],
    ])->dropDownList( \yii\helpers\ArrayHelper::map($model->getReferences(), 'id', 'title'), [
        'value' => (!$model->isNewRecord && is_object($model->creditProductFieldReference)) ? $model->creditProductFieldReference->credit_product_field_reference_id : ''
    ]) ?>

    <?= $form->field($model, 'credit_product_type_id')->dropDownList( \yii\helpers\ArrayHelper::map($model->getTypes(), 'id', 'title') ) ?>

    <?= $form->field($model, 'multiple')->dropDownList( $model->multipleList() ) ?>

    <?= $form->field($model, 'multiple_count', ['options' => ['class' => $model->multiple ? '' : 'hidden']])->dropDownList( $model->countList() ) ?>

    <?= $form->field($model, 'show_in')->dropDownList($model->showInList()) ?>

    <?= $form->field($model, 'show_place')->dropDownList( $model->showPlaceList() ) ?>

    <?= $form->field($model, 'sort')->input('number', ['value' => $model->isNewRecord ? 0 : $model->sort]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList( $model->getAvailableStatuses(false), ['value' => $model->isNewRecord ? 0 : $model->status] ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
