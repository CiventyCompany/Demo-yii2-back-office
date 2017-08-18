<?php
use \backend\modules\user\models\UserSettingsSearch;
use \yii\widgets\Pjax;
use yii\grid\GridView;
/**
 * @var \backend\modules\user\models\UserSettingsSearch $UserSettingsSearch
 * @var \yii\data\ActiveDataProvider $UserSettingsSearchDataProvider
*/
$names = UserSettingsSearch::getSubscribeSettings();
?>

<?php Pjax::begin(); ?>

<?= GridView::widget([
    'dataProvider' 	=> $UserSettingsSearchDataProvider,
    'filterModel'  	=> $UserSettingsSearch,
    'layout'  		=> "{items}\n{pager}",
    'columns' => [
        [
            'attribute' => 'name',
            'value' => function($model) use ($names) {
                return $names[$model->name];
            },
            'filter' => false,
        ],
        [
            'attribute' => 'value',
            'format' => 'raw',
            'value' => function($model){
                return $model->value ? '<span class="label label-success">' . Yii::t('app', 'Yes') . '</span>' : '<span class="label label-danger">' . Yii::t('app', 'No') . '</span>';
            },
            'filter' => false,
        ]
    ],
]);

?>

<?php Pjax::end(); ?>