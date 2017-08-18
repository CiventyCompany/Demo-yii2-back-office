<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \common\modules\identification\models\IdentificationOffice */

$this->title = $model->identificationMethod->product->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Office'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
                'attribute' => 'city_id',
                'value' => $model->city->name
            ],
            [
                'attribute' => 'identification_method_id',
                'value' => $model->identificationMethod->product->title,
            ],
            'address',
            'phone',
            'mode',
        ],
    ]) ?>

</div>
