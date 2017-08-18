<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \backend\modules\credit_rating\models\advanced\CreditRatingAdvancedRequest */

\backend\assets\JqueryMouseWheelAsset::register( $this );

$this->title = Yii::t('app', 'Request card') . ' ' . $model->modelsTranslate()[$model->model] . ' №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Credit Rating Advanced Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$items = [];
foreach ($model->getTabs( $model->advancedModel ) as $relation => $info){
    $items[] = [
        'label' => $info['label'],
        'content' => $this->render('_view_content', [
            'models' => $model->advancedModel->{$relation},
            'relations' => isset($info['relations']) ? $info['relations'] : []
        ]),
    ];
}
?>
<div class="credit-rating-advanced-request-view">

    <?= \yii\bootstrap\Tabs::widget([
        'items' => $items,
        'itemOptions' => [
            'class' => 'horizontal-scroll-pane'
        ]
    ]);?>

    <?php /* DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'model',
            'created_at',
            'status',
            'base_file_name',
        ],
    ])*/ ?>

</div>
