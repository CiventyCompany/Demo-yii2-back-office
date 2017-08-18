<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\app_interface\models\StopWords */

$this->title = Yii::t('app','Create Stop Word');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Stop Words'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stop-words-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
