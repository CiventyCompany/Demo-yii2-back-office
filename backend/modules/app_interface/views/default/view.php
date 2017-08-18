<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\modules\app_interface\models\SourceMessage;

/* @var $this yii\web\View */
/* @var $model common\modules\app_interface\models\SourceMessage */

$this->title = $model[0]->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Source Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-message-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model[0]->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model[0]->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'id',
                'label' => $model[0]->getAttributeLabel('id'),
                'value' => $model[0]->id
            ],
            [
                'attribute' => 'category',
                'label' => $model[0]->getAttributeLabel('category'),
                'value' => SourceMessage::getModels()[$model[0]->category]
            ],
            [
                'attribute' => 'message',
                'label' => $model[0]->getAttributeLabel('message'),
                'value' => $model[0]->message
            ],
            [
                'attribute' => 'translation',
                'label' => Yii::t('app', 'Translation'),
                'value' => isset(\yii\helpers\ArrayHelper::index($model[0]->messages, 'language')['ru']) ?
                    \yii\helpers\ArrayHelper::index($model[0]->messages, 'language')['ru']->translation :
                    null
            ]
        ],
    ]) ?>

</div>
