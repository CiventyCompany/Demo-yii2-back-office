<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\credit_product\models\CreditProductReview */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="credit-product-review-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?php /*

    <?= $form->field($model, 'credit_product_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'rating')->textInput() ?>

    <?= $form->field($model, 'likes_count')->textInput() ?>

    <?= $form->field($model, 'dislikes_count')->textInput() ?>

    <?= $form->field($model, 'comments_count')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    */?>
    <?= $form->field($model, 'status')->dropDownList( $model->getAvailableStatuses(false) ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
