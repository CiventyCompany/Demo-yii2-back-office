<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\user\helpers\UserDataHelper;
use yii\jui\DatePicker;

$this->title = Yii::t('app', 'Bonus');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Pjax::begin() ?>

<?= GridView::widget([
    'dataProvider' 	=> $dataProvider,
    'filterModel'  	=> $searchModel,
    'layout'  		=> "{items}\n{pager}",
    'columns' => [
        'id',
        'name',
        'price',
        'title',
        'description',
        'link',
        [
            'class' => \yii\grid\ActionColumn::className(),
            'template'=>'{update}',
        ]
    ],
]); ?>

<?php Pjax::end() ?>
