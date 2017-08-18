<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\modules\identification\models\search\IdentificationMethodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Identification Methods');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="identification-method-index">
    <p>
        <?= Html::a(Yii::t('app', 'Create Identification Method'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'product_id',
                'value' => function($model){
                    return $model->product->title;
                },
                'filter' => Html::activeDropDownList( $searchModel, 'product_id', $searchModel::getProductsList( true ), ['prompt' => '', 'class' => 'form-control'] )
            ],
            'time',
            //'created_at',
            'timeout',
            [
                'attribute' => 'alias',
                'value' => function($model){
                    $types = $model::geyAliasTypes();
                    return $types[ $model->alias ];
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
