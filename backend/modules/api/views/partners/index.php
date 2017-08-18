<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Partners');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partners-index">

    <p>
        <?= Html::a(Yii::t('app','Add partner'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id',
            [
                'label' => Yii::t('app','Partner'),
                'attribute' => 'user_id',
                'format' => 'raw',
                'value' => function($model){
                   return $model->getUserName();
                }
            ],
            'access_token',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>
</div>
