<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\community\models\QComments */

$this->title = 'Create Qcomments';
$this->params['breadcrumbs'][] = ['label' => 'Qcomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qcomments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
