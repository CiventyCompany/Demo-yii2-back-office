<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \backend\modules\common\models\search\ReferenceBookSearch */

$this->title = Yii::t('app', 'Reference Books');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reference-book-index">
    <?php Pjax::begin(); ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Reference Book'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $model,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}'
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
