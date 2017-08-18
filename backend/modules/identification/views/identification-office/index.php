<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel \backend\modules\identification\models\search\IdentificationOfficeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Offices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="identification-method-index">
    <p>
        <?= Html::a(Yii::t('app', 'Create Office'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            [
                'attribute' => 'city_id',
                'value' => function($model){
                    return $model->city->name;
                },
            ],
            [
                'attribute' => 'identification_method_id',
                'value' => function($model){
                    return $model->identificationMethod->product->title;
                },
                'filter' => Html::activeDropDownList( $searchModel, 'identification_method_id', $searchModel::getIdentificationMethods( true ), ['prompt' => '', 'class' => 'form-control'] ),
            ],
            'address',
            'phone',
            'mode',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
