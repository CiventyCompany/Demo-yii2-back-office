<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\common\models\ReferenceBookValues */

$this->title = Yii::t('app', 'Update value for {book}', [
    'book' => $model->referenceBook->title
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reference Book Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->reference_book_id, 'url' => ['view', 'id' => $model->reference_book_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="reference-book-values-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
