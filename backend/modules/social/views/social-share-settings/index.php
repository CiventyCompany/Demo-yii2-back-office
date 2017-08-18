<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use \backend\modules\social\models\SocialShareSettings;

$this->title = Yii::t('app', 'Sharing settings');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Pjax::begin() ?>

<?= GridView::widget([
    'dataProvider' 	=> $dataProvider,
    'filterModel'  	=> $searchModel,
    'layout'  		=> "{items}\n{pager}",
    'columns' => [
        'social_id',
        'social_name',
    ],
]); ?>

<?php Pjax::end() ?>
