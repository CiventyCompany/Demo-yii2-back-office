<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\event\models\EventAction */
/* @var $form yii\widgets\ActiveForm */
/* @var $eventHandler \common\modules\event\models\EventHandler */
?>

<div class="event-action-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => false,
        'enableClientScript' => false,
        'enableClientValidation' => false
    ]); ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'model')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'event_name')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'settings')->textarea(['class' => 'hidden'])->label(false) ?>

    <?= $form->field($model, 'handler_model')->dropDownList( $model->getAvailableModels( $eventHandler->getOnly( $model->model, $model->event_name ) ), ['prompt' => '', 'id' => 'handler_model'] ) ?>

    <hr />

    <div id="handler-model-settings">
        <?php
        if( count($model->getErrors('modelSettings')) ){
            foreach( $model->getErrors('modelSettings') as $error ){
                ?><p class="text-danger"><?= $error ?></p><?php
            }
        }
        if( strlen($model->handler_model) ){
            echo $model->getModelSettings( $model->handler_model, $model->modelSettings );
        }
        ?>
    </div>

    <?= \backend\helpers\TokenHelper::show( $model->getModelTokens() ) ?>

    <hr />

    <?= $form->field($model, 'status')->dropDownList( $model->getStatusList() ) ?>

    <?= $form->field($model, 'priority')->hiddenInput(['min' => -128, 'max' => 127, 'value' => $model->priority ? $model->priority : 0])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
