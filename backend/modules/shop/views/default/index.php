<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use \yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::t('app', 'All products');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= Html::a(Yii::t('app', 'Create'), Url::to(['/shop/default/create']), ['class' => 'btn btn-success', 'data-pjax' => 0]); ?>

<?php Pjax::begin() ?>

<?= GridView::widget([
    'dataProvider' 	=> $dataProvider,
    'filterModel'  	=> $searchModel,
    'layout'  		=> "{items}\n{pager}",
    'columns' => [
        'title',
        'description',
        'price',
        'link',
        [
            'class' => \yii\grid\ActionColumn::className(),
            'template'=>'{update}',
        ]
    ]
]);
?>

<?php Pjax::end() ?>
