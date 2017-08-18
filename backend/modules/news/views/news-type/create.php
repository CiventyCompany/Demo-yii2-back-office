<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\news\models\NewsType */

$this->title = Yii::t('app', 'Create News Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
