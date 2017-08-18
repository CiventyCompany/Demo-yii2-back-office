<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\common\models\ReferenceBook */

$this->title = Yii::t('app', 'Create Reference Book');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reference Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reference-book-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
