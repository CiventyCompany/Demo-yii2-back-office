<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use \common\modules\app_interface\models\SourceMessage;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Source Messages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-message-index" style="overflow-x: auto">
    <p>
        <?= Html::a(Yii::t('app', 'Create Source Message'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'category',
                'label' => Yii::t('app', 'Category'),
                'format' => 'raw',
                'value' => function($model){
                    return isset(SourceMessage::getModels()[$model->category]) ? SourceMessage::getModels()[$model->category] : null;
                },
                'filter' => Html::activeDropDownList($searchModel, 'category', SourceMessage::getModels(),
                    ['class'=>'form-control','prompt' => Yii::t('app', 'Select Category')])
            ],
            'message:ntext',
            [
                'attribute' => 'translation',
                'label' => Yii::t('app', 'Translation'),
                'format' => 'raw',
                'value' => function($model){
                    $mes = \yii\helpers\ArrayHelper::index($model->messages, 'language');
                    return key_exists('ru', $mes) ? $mes['ru']->translation : null;
                },
                'filter' => Html::activeCheckbox($searchModel, 'onlyWithoutTranslate', ['label' => '', 'labelOptions' => ['class' => 'left']]) . Html::activeTextInput($searchModel, 'translation', ['class' => 'form-control'])
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
