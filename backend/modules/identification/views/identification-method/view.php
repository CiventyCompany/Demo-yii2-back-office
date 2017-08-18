<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\identification\models\IdentificationMethod */

$this->title = $model->product->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Identification Methods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$types = $model::geyAliasTypes();
?>
<div class="identification-method-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'product_id',
                'value' => $model->product->title
            ],
            'time',
            'created_at',
            'timeout',
            [
                'attribute' => 'alias',
                'value' => $types[ $model->alias ]
            ],
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => Html::img( Yii::$app->params['frontURL'] . $model->image, ['width' => $model->icon_width, 'height' => $model->icon_height]),
            ],
            [
                'attribute' => 'icon',
                'format' => 'raw',
                'value' => Html::img( Yii::$app->params['frontURL'] . $model->icon, ['width' => $model->icon_width, 'height' => $model->icon_height]),
            ],
        ],
    ]) ?>

</div>
