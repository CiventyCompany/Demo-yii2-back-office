<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\news\models\NewsCategory */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'News Category',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="news-category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
