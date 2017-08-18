<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\common\models\ReferenceBook */
/* @var $searchModel \backend\modules\common\models\search\ReferenceBookValuesSearch */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reference Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="reference-book-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <hr />

    <?php \yii\widgets\Pjax::begin(); ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Reference Book Values'), ['/common/reference-book-values/create', 'reference_book_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'reference_book_id',
            'key',
            'value',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'urlCreator' => function ($action, $model, $key, $index, \yii\grid\ActionColumn $this) {
                    return \yii\helpers\Url::to(["/common/reference-book-values/$action", 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>
