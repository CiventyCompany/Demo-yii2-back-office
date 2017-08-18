<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\user\models\UserSecretQuestionList */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'User Secret Question List',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Secret Question Lists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-secret-question-list-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
