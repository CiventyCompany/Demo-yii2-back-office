<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\community\models\QuestionsCategories;

/* @var $this yii\web\View */
/* @var $model common\modules\community\models\Questions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="questions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'body')->textarea(['maxlength' => true, 'rows'=>'12']); ?>

    <?= $form->field($model,'category_id')->dropDownList(QuestionsCategories::getCategoriesDropDown()); ?>

    <?= $form->field($model, 'm_status')->dropDownList(\common\modules\community\models\Questions::getStatusDropDown()); ?>

    <?= $form->field($model, 'created_at')->textInput(['disabled'=>true]); ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]); ?>

    <div class="form-group">
        <div class="btn-group">
            <a href="/user/registered/view?id=<?= $model->user_id; ?>" target="_blank">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-user" aria-hidden="true"></i> <?= Yii::t('app','User'); ?>: <?= \backend\modules\user\models\Profile::getUserFullName($model->user_id); ?>
                </button>
            </a>
        </div>
    </div>
    <div class="form-group">
        <div class="btn-group">
            <button type="button" class="btn btn-success">
                <i class="fa fa-thumbs-up" aria-hidden="true"></i> <?= $model->likes; ?>
            </button>
            <button type="button" class="btn btn-danger">
                <i class="fa fa-thumbs-down" aria-hidden="true"></i> <?= $model->dislikes; ?>
            </button>
            <button type="button" class="btn btn-info">
                <i class="fa fa-eye" aria-hidden="true"></i> <?= $model->views; ?>
            </button>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
