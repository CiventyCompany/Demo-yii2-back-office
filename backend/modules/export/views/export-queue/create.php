<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model admin_backend\modules\site\models\ExportQueue */

$this->title = Yii::t('app', 'Create Export Queue');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Export Queues'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="export-queue-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
