<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\modules\app_interface\models\Seo;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\app_interface\models\SeoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'SEO');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'data.title',
                'filter' => Html::activeTextInput($searchModel, 'seoTitle', ['class' => 'form-control'])
            ],
            'url',
//
//            [
//                'attribute' => 'data.h1',
//                'filter' => Html::activeTextInput($searchModel, 'seoH1', ['class' => 'form-control'])
//            ],
//            [
//                'attribute' => 'data.description',
//                'filter' => Html::activeTextInput($searchModel, 'seoDescription', ['class' => 'form-control'])
//            ],
//            [
//                'attribute' => 'data.keywords',
//                'filter' => Html::activeTextInput($searchModel, 'seoKeywords', ['class' => 'form-control'])
//            ],
            [
                'attribute' => 'type',
                'format' => 'raw',
                'value' => function($model){
                    /**
                     * @var $model \common\modules\app_interface\models\Seo
                     */
                    return $model->getCurrentType();
                },
                'filter' => Html::activeDropDownList($searchModel, 'type', Seo::getPageTypes(), ['class' => 'form-control', 'prompt' => ''])
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}'
            ],
        ],
    ]); ?>
</div>
