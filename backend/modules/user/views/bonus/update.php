<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Bonus');
$this->params['breadcrumbs'][] = $this->title;

/**
 * @var $model \backend\modules\user\models\UserActionPrice;
 */
?>

<section class="content">
    <?php $form = ActiveForm::begin(
        [
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal']
        ]
    ) ?>

    <?= $form->field($model, 'price')->textInput(); ?>

    <?= $form->field($model, 'title')->textInput(); ?>

    <?= $form->field($model, 'description')->textarea(); ?>

    <?= $form->field($model, 'link')->textInput(); ?>

    <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']); ?>

    <?php ActiveForm::end() ?>
</section>