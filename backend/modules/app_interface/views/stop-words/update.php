<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\app_interface\models\StopWords */

$this->title = Yii::t('app','Update Stop Word: ' ). $model->word;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Stop Words'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->word, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="stop-words-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
