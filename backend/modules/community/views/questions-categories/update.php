<?php


/* @var $this yii\web\View */
/* @var $model common\modules\community\models\QuestionsCategories */

$this->title = Yii::t('app','Update Category: '). $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->category_id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="questions-categories-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
