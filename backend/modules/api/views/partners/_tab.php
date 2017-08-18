<?php
use backend\modules\api\models\PartnerFields;

/**
 * @var $model \yii\db\ActiveRecord
 * @var $form \yii\widgets\ActiveForm
 * @var $partner \backend\modules\api\models\Partners
 * @var $i
 */

$columns = PartnerFields::getModelFields($model);
?>

<div class="panel panel-default">
    <table class="table table-striped table-hover">
        <tr>
            <th><?= Yii::t('app', 'Field'); ?></th>
            <th><?= Yii::t('app', 'Model'); ?></th>
            <th>
                <?= Yii::t('app', 'Access'); ?><br>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-info mark-yes">Все "Да"</button>
                    <button type="button" class="btn btn-sm btn-info mark-no">Все "Нет"</button>
                </div>
            </th>
        </tr>
        <?php $i = 0; ?>
        <?php foreach ($columns as $columnName): ?>
            <?php
                $field = PartnerFields::ambiguousColumns($columnName, $model);
                $isChecked = PartnerFields::isCheckedColumn($partner->id, $field, $model::className());
            ?>
            <tr>
                <td><?= $columnName; ?></td>
                <td><?= $model::className(); ?></td>
                <td>
                    <input class="field-yes" type="radio" name="PartnerFields[<?= $model->getModelName() ?>][<?= $i; ?>][field]"
                           value="<?= $field; ?>" <?= $isChecked ? 'checked="checked"' : '' ?>> Да
                    <input class="field-no" type="radio" name="PartnerFields[<?= $model->getModelName() ?>][<?= $i; ?>][field]"
                           value="null" <?= !$isChecked ? 'checked="checked"' : '' ?>> Нет
                </td>
            </tr>
            <input type="hidden" name="PartnerFields[<?= $model->getModelName() ?>][<?= $i; ?>][model]"
                   value="<?= $model::className(); ?>">
            <input type="hidden" name="PartnerFields[<?= $model->getModelName() ?>][<?= $i; ?>][partner_id]"
                   value="<?= $partner->id; ?>">
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</div>
