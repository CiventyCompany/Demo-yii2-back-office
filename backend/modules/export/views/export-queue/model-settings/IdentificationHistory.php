<?php
use yii\helpers\Html;
/**
 * @var \yii\web\View $this
 * @var string $fieldNamePrefix
 * @var \common\modules\identification\models\IdentificationHistory $model
 */
$methodsArr = [];
$methods = \common\modules\identification\models\IdentificationMethod::find()->all();
foreach ($methods as $method){
    $methodsArr[ $method->id ] = $method->product->title;
}
?>

<div class="form-group">
    <label class="control-label"><?= Yii::t('app', 'Created At') ?></label>
    <div class="row">
        <div class="col-xs-6">
            <input name="<?= $fieldNamePrefix ?>[created_at][from]" class="datetimepicker form-control" placeholder="<?= Yii::t('app', 'From date:') ?>">
        </div>
        <div class="col-xs-6">
            <input name="<?= $fieldNamePrefix ?>[created_at][to]" class="datetimepicker form-control" placeholder="<?= Yii::t('app', 'To date:') ?>">
        </div>
    </div>
    <label class="control-label"><?= Yii::t('app', 'Closed At') ?></label>
    <div class="row">
        <div class="col-xs-6">
            <input name="<?= $fieldNamePrefix ?>[closed_at][from]" class="datetimepicker form-control" placeholder="<?= Yii::t('app', 'From date:') ?>">
        </div>
        <div class="col-xs-6">
            <input name="<?= $fieldNamePrefix ?>[closed_at][to]" class="datetimepicker form-control" placeholder="<?= Yii::t('app', 'To date:') ?>">
        </div>
    </div>
    <label class="control-label"><?= Yii::t('app', 'Method') ?></label>
    <div class="row">
        <div class="col-xs-12">
            <?= Html::dropDownList($fieldNamePrefix . '[identification_method_id]', null, $methodsArr, ['class' => 'form-control', 'prompt' => Yii::t('app', 'All'), 'multiple' => 'multiple']) ?>
        </div>
    </div>
    <label class="control-label"><?= Yii::t('app', 'Status') ?></label>
    <div class="row">
        <div class="col-xs-12">
            <?= Html::dropDownList($fieldNamePrefix . '[status]', null, $model->getStatuses(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All'), 'multiple' => 'multiple']) ?>
        </div>
    </div>
</div>
