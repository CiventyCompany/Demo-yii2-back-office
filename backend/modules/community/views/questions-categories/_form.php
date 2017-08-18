<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\modules\community\models\QuestionsCategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="questions-categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sort')->input('number'); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'suffix')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'rows' => '12']); ?>

    <?= $form->field($model, 'parent_category_id')
        ->dropDownList(\common\modules\community\models\QuestionsCategories::getParentCategoriesDropDown(), ['prompt' => '',]); ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Create'): Yii::t('app','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
