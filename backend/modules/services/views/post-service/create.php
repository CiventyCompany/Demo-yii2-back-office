<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\services\models\PostService */

$this->title = Yii::t('app', 'Create Post Service');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Post Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-service-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
