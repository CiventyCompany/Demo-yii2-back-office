<?php
use yii\widgets\Pjax;
use yii\grid\GridView;

/**
 * @var \yii\data\ActiveDataProvider $UserAvatarSearchDataProvider
 * @var \common\modules\user\models\UserAvatarSearch $UserAvatarSearch
 */
?>
<?php Pjax::begin(); ?>

<?= GridView::widget([
    'dataProvider' 	=> $UserAvatarSearchDataProvider,
    'filterModel'  	=> $UserAvatarSearch,
    'layout'  		=> "{items}\n{pager}",
    'columns' => [
        [
            'attribute' => 'old_avatar_id',
            'value' => function($model){
                return  $model->old_avatar_id ? \yii\bootstrap\Html::img( Yii::$app->params['frontURL'] . $model->old->avatar, ['width' => 100] ) : '';
            },
            'filter' => false,
            'format' => 'raw',
        ],
        [
            'attribute' => 'status',
            'value' => function($model){
                return $model->getStatuses()[ $model->status ];
            },
            'filter' => false,
        ],
        [
            'attribute' => 'moderation_status',
            'value' => function($model){
                return $model->getModerationStatuses()[ $model->moderation_status ];
            },
            'filter' => false,
        ],
        [
            'attribute' => 'avatar',
            'value' => function($model){
                return  \yii\bootstrap\Html::img( Yii::$app->params['frontURL'] . $model->avatar, ['width' => 100] );
            },
            'filter' => false,
            'format' => 'raw',
        ],
    ],
]);
?>

<?php Pjax::end(); ?>