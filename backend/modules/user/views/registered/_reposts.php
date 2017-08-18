<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;

/* @var $repostsSearchModel \backend\modules\social\models\SocialShareSearch */
/* @var $repostsDataProvider \backend\modules\social\models\SocialShare */
?>

<?php Pjax::begin(); ?>

<?= GridView::widget([
    'dataProvider' 	=> $repostsDataProvider,
    'filterModel'  	=> $repostsSearchModel,
    'layout'  		=> "{items}\n{pager}",
    'columns' => [
        'id',
        [
            'attribute' => 'social_name',
            'value' => 'settings.social_name',
        ],
        'post_id',
        [
            'attribute' => 'created_at',
            'format' => ['date', 'php:d-m-Y'],
            'filter' => DatePicker::widget([
                'model'      => $repostsSearchModel,
                'attribute'  => 'created_at',
                'dateFormat' => 'php:d-m-Y',
                'options' => [
                    'class' => 'form-control',
                ],
            ]),
        ],
        [
            'class' => \yii\grid\ActionColumn::className(),
            'buttons'=>[
                'view'=>function ($url, $model) {
                    $customurl = Yii::$app->getUrlManager()->createUrl(['social/social-share/view', 'id' => $model->id]);
                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-eye-open"></span>', $customurl,
                        ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
                }
            ],
            'template'=>'{view}',
        ]
    ],
]);

?>

<?php Pjax::end(); ?>