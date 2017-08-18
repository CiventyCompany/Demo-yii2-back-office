<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\credit_product\models\search\CreditProductReferenceValuesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Credit Product Reference Values');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-product-reference-values-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <br />
    <p>
        <?= Html::a(Yii::t('app', 'Create Credit Product Reference Values'), ['/credit_product/credit-product-reference-values/create', 'credit_product_reference_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //'id',
            'sort',
            /*
            [
                'attribute' => 'credit_product_reference_id',
                'filter' => Html::activeDropDownList($searchModel, 'credit_product_reference_id', \yii\helpers\ArrayHelper::map($searchModel->getReferences(), 'id', 'title'), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
                'value' => function($model){
                    return $model->creditProductReference->title;
                }

            ],
            */
            'value',
            [
                'label' => '',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['/credit_product/credit-product-reference-values/update', 'id' => $model->id], ['title' => 'Редактировать', 'aria-label' => 'Редактировать', 'data-pjax' => 0]) . ' ' .
                    Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/credit_product/credit-product-reference-values/delete', 'id' => $model->id], ['title' => 'Удалить', 'aria-label' => 'Удалить', 'data-pjax' => 0, 'data-confirm' => 'Вы уверены, что хотите удалить этот элемент?', 'data-method' => 'post']);
                }
            ],
            /*
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
            */
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
