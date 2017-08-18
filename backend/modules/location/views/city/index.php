<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \backend\modules\identification\models\search\IdentificationHistorySearch */


$this->title = Yii::t('app', 'City');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create City'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'filterModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'options' => [
            'overflow' =>  'auto'
        ],
        'columns' => [
            [
                'attribute' => 'city_id',
                'label' => Yii::t('app', 'City Id'),
            ],
            [
                'label' => Yii::t('app', 'Region'),
                'attribute' => 'region_id',
                'value' => function($model){
                    return $model->region->name;
                },
                'filter' => Html::activeDropDownList( $searchModel, 'region_id', $searchModel->getRegions(), ['prompt' => '', 'class' => 'form-control'] )
            ],
            'name',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
