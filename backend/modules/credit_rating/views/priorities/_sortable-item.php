<?php
use yii\bootstrap\Html;
/**
 *@var \common\modules\credit_rating\models\CreditRatingHistoryFieldPriority $model
 * @var array $item
 * @var integer $priority
 */
?>
<?= Html::activeHiddenInput($model, 'model[]', ['value' => $item['model']]) ?>
<?= Html::activeHiddenInput($model, 'priority[]', ['value' => $priority]) ?>
<div class="row">
    <div class="col-md-1 move-block">
        <i class="glyphicon glyphicon-move"></i>
    </div>
    <div class="col-md-11">
        <?= $item['label'] ?>
    </div>
</div>