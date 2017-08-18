<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \common\modules\identification\models\IdentificationMethod */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="identification-method-form">

    <h3><?= Yii::t('app', 'The town in which method available') ?></h3>

    <?php $form = ActiveForm::begin(['options' => ['id' => 'method-cities']]); ?>

    <?= Html::HiddenInput( 'IdentificationMethodCity[identification_method_id]', $model->id ) ?>

    <?= \nex\chosen\Chosen::widget([
        'name' => 'IdentificationMethodCity[city_id]',
        'value' => $model->getActiveCityIds(),
        'items' => $model->getCities(),
        'multiple' => true,
        'placeholder' => 'Select',
    ]);?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
