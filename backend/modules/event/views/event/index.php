<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\event\models\search\EventSearch */
/* @var $dataProvider \yii\data\ArrayDataProvider */

$this->title = Yii::t('app', 'Event Actions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-action-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'group',
                'filter' => Html::activeDropDownList($searchModel, 'group', $searchModel->getGroups(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
                'value' => function($model){
                    return $model->group;
                }
            ],
            [
                'attribute' => 'label',
                'filter' => Html::activeDropDownList($searchModel, 'label', $searchModel->getLabels(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
                'value' => function($model){
                    return $model->label;
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'urlCreator' => function($action, $model, $key, $index){
                    return $action == 'update' ? ['/event/event/update', 'model' => \common\helpers\ClassHelper::getClassName($model->model), 'event_name' => $model->name] : '#';
                }
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
