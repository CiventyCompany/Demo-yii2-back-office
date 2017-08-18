<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \common\modules\location\models\Region */

$this->title = Yii::t('app', 'Create Region');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Region'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
