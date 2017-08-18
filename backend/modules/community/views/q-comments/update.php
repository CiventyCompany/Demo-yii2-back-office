<?php


/* @var $this yii\web\View */
/* @var $model common\modules\community\models\QComments */

$this->title = Yii::t('app','Update Comment: ' ). $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Commentaries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->commentary_id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="qcomments-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
