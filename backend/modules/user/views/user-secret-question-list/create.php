<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\user\models\UserSecretQuestionList */

$this->title = Yii::t('app', 'Create User Secret Question List');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Secret Question Lists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-secret-question-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
