<?php


/* @var $this yii\web\View */
/* @var $model common\modules\community\models\Questions */

$this->title = Yii::t('app','Update Questions: '). $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->question_id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="questions-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
