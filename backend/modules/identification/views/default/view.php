<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \common\modules\identification\models\IdentificationHistory */

$this->title = $model->user->getName( true );
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Identifications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="identification-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'user_id',
                'value' => $model->user->getName( true ),
            ],
            [
                'attribute' => 'identification_method_id',
                'value' => $model->identificationMethod->product->title,
            ],
            [
                'attribute' => 'city_id',
                'value' => $model->city->name . ' ' . $model->data->getAddress(),
            ],
            [
                'label' => Yii::t('app', 'Phone'),
                'value' => $model->data->getPhone()
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => $model->getStatusText(),
            ],
            'created_at',
            'closed_at',
        ],
    ]) ?>

</div>
