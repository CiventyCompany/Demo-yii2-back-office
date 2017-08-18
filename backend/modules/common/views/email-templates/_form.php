<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\common\models\EmailTemplates */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="email-templates-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'header')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'footer')->textarea(['rows' => 6]) ?>

    <div class="tokens-list-wrap">
        <h3>Подставочные шаблоны (обязательные для заполнения)</h3>
        <ul class="tokens-list">
            <li>[beginPage] - Начало страницы</li>
            <li>[charset] - Кодировка</li>
            <li>[head] - Шапка</li>
            <li>[beginBody] - Начало контента</li>
            <li>[endBody] - Окончание контента</li>
            <li>[endPage] - Окончание страницы</li>
        </ul>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
