<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\credit_product\models\CreditProductReference */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Credit Product Reference',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Credit Product References'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="credit-product-reference-update">

    <?= \yii\bootstrap\Tabs::widget([
        'items' => [
            [
                'label' => Yii::t('app', 'Main information'),
                'content' =>  $this->render('_form', ['model' => $model]),
                'active' => (!isset($_GET['tab']) || $_GET['tab'] == 'main') ? true : false,
            ],
            [
                'label' => Yii::t('app', 'Values'),
                'content' =>  $this->render('@backend/modules/credit_product/views/credit-product-reference-values/index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model
                ]),
                'active' => (isset($_GET['tab']) && $_GET['tab'] == 'values') ? true : false,
            ],
        ],
    ]);?>
</div>
