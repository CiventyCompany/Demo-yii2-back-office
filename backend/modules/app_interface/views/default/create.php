<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\app_interface\models\SourceMessage */

$this->title = Yii::t('app', 'Create Source Message');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Source Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-message-create">

    <?= $this->render('_form', [
        'model' => $model,
        'messages' => $messages
    ]) ?>

</div>
