<?php
use yii\helpers\Html;
/**
 * @var \yii\web\View $this
 * @var string $fieldNamePrefix
 * @var \common\modules\user\models\UserRegisterLog $model
 */
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
    <label class="control-label"><?= Yii::t('app', 'Updated At') ?></label>
    <div class="row">
        <div class="col-xs-6">
            <input name="<?= $fieldNamePrefix ?>[updated_at][from]" class="datetimepicker form-control" placeholder="<?= Yii::t('app', 'From date:') ?>">
        </div>
        <div class="col-xs-6">
            <input name="<?= $fieldNamePrefix ?>[updated_at][to]" class="datetimepicker form-control" placeholder="<?= Yii::t('app', 'To date:') ?>">
        </div>
    </div>
    <label class="control-label"><?= Yii::t('app', 'Status') ?></label>
    <div class="row">
        <div class="col-xs-12">
            <?= Html::dropDownList( $fieldNamePrefix . '[user_id]', null, [
                0 => Yii::t('app','In process'),
                1 => Yii::t('app','Completed'),
            ], ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')] ) ?>
        </div>
    </div>
</div>
