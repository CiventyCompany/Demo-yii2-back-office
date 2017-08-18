<?php
use yii\helpers\Html;
/**
 * @var \yii\web\View $this
 * @var string $fieldNamePrefix
 * @var \common\modules\user\models\User $model
 */
?>

<div class="form-group">
    <label class="control-label"><?= Yii::t('app', 'Registration date') ?></label>
    <div class="row">
        <div class="col-xs-6">
            <input name="<?= $fieldNamePrefix ?>[created_at][from]" class="datetimepicker form-control" placeholder="<?= Yii::t('app', 'From date:') ?>">
        </div>
        <div class="col-xs-6">
            <input name="<?= $fieldNamePrefix ?>[created_at][to]" class="datetimepicker form-control" placeholder="<?= Yii::t('app', 'To date:') ?>">
        </div>
    </div>
    <label class="control-label"><?= Yii::t('app', 'Last activity at') ?></label>
    <div class="row">
        <div class="col-xs-6">
            <input name="<?= $fieldNamePrefix ?>[last_activity_at][from]" class="datetimepicker form-control" placeholder="<?= Yii::t('app', 'From date:') ?>">
        </div>
        <div class="col-xs-6">
            <input name="<?= $fieldNamePrefix ?>[last_activity_at][to]" class="datetimepicker form-control" placeholder="<?= Yii::t('app', 'To date:') ?>">
        </div>
    </div>
    <label class="control-label"><?= Yii::t('app', 'Moderation Status') ?></label>
    <div class="row">
        <div class="col-xs-12">
            <?= Html::dropDownList( $fieldNamePrefix . '[m_status]', null, $model->getMStatuses(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All'), 'multiple' => 'multiple'] ) ?>
        </div>
    </div>
    <label class="control-label"><?= Yii::t('app', 'Verified Status') ?></label>
    <div class="row">
        <div class="col-xs-12">
            <?= Html::dropDownList( $fieldNamePrefix . '[verified_status]', null, $model->getStatuses(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All'), 'multiple' => 'multiple'] ) ?>
        </div>
    </div>
    <label class="control-label"><?= Yii::t('app', 'Phone Confirm Status') ?></label>
    <div class="row">
        <div class="col-xs-12">
            <?= Html::dropDownList( $fieldNamePrefix . '[phone_confirm]', null, [Yii::t('app', 'No'), Yii::t('app', 'Yes')], ['class' => 'form-control', 'prompt' => Yii::t('app', 'All'), 'multiple' => 'multiple'] ) ?>
        </div>
    </div>
    <label class="control-label"><?= Yii::t('app', 'Email Confirm Status') ?></label>
    <div class="row">
        <div class="col-xs-12">
            <?= Html::dropDownList( $fieldNamePrefix . '[email_confirm]', null, [Yii::t('app', 'No'), Yii::t('app', 'Yes')], ['class' => 'form-control', 'prompt' => Yii::t('app', 'All'), 'multiple' => 'multiple'] ) ?>
        </div>
    </div>
    <label class="control-label"><?= Yii::t('app', 'Credit Rating') ?></label>
    <div class="row">
        <div class="col-xs-6">
            <input name="<?= $fieldNamePrefix ?>[cr][from]" class="form-control" placeholder="<?= Yii::t('app', 'From:') ?>" type="number" min="0" max="1000">
        </div>
        <div class="col-xs-6">
            <input name="<?= $fieldNamePrefix ?>[cr][to]" class="form-control" placeholder="<?= Yii::t('app', 'To:') ?>" type="number" min="0" max="1000">
        </div>
    </div>
</div>
