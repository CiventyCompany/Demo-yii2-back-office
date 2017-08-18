<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\common\models\ReferenceBookValues */

$this->title = Yii::t('app', 'Create Reference Book Values');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reference Book Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reference-book-values-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
