<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\credit_rating\models\CreditRatingModelsTimeout */
/* @var $form yii\widgets\ActiveForm */

$disabledModels = [];
foreach ($activeModels as $activeModel){
    $disabledModels[ $activeModel->model ] = ['disabled' => true];
}
if($model->isNewRecord){
    $options = ['options' => $disabledModels];
} else {
    $options = ['disabled' => 'disabled'];
}
?>

<div class="credit-rating-models-timeout-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'model')->dropdownList($models, $options) ?>

    <?= $form->field($model, 'timeout')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
