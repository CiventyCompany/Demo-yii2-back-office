<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\event\models\EventActionCondition */
/* @var $form yii\widgets\ActiveForm */
/* @var $eventAction common\modules\event\models\EventAction */
$keys = $values = [];
$conditions = $eventAction->getModelConditions();
foreach ($conditions as $key => $data){
    $keys[$key] = $data['label'];
    foreach ($data['values'] as $valueKey => $valueLabel){
        $values[ $key ][ $valueKey ] = $valueLabel;
    }
}
$model->operator = '=';
?>

<div class="event-action-condition-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'event_action_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'key')->dropDownList( $keys ) ?>

    <?= $form->field($model, 'value')->dropDownList( $model->key ? $values[$model->key] : []) ?>

    <?= $form->field($model, 'operator')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <script type="text/javascript">var eventConditions = <?= json_encode($values) ?>;</script>
</div>
