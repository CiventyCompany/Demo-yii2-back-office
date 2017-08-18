<?php


/* @var $this yii\web\View */
/* @var $model common\modules\community\models\QuestionsCategories */

$this->title = Yii::t('app','Create Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-categories-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
