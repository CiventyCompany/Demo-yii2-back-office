<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\services\models\search\PhoneOperatorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Phone Operators');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phone-operator-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Phone Operator'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'operator',
            [
                'attribute' => 'icon',
                'format' => 'raw',
                'value' => function( $model ){
                    return Html::img( Yii::$app->params['frontURL'] . \frontend\helpers\ImageHelper::thumbnail( $model->icon, 30, 30 ) );
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
