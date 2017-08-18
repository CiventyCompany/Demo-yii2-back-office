<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\credit_product\models\search\CreditProductCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $types \common\modules\credit_product\models\CreditProductType */
/* @var $typeId integer */

$this->title = Yii::t('app', 'Credit Product Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-product-category-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Credit Product Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    $items = [];
    foreach ($types as $type){
        if($typeId == $type->id){
            $items[] = [
                'label' => $type->title,
                'content' =>  $this->render('_index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                ]),
                'active' => true
            ];
        } else {
            $items[] = [
                'label' => $type->title,
                'url' => ['/credit_product/credit-product-category/index', 'typeId' => $type->id],
            ];
        }
    }
    ?>
    <?= \yii\bootstrap\Tabs::widget([
        'items' => $items
    ]);?>
</div>
