<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\community\models\Questions;

/* @var $this yii\web\View */
/* @var $model common\modules\community\models\QComments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="qcomments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'entity_id')->textInput(['disabled'=>true, 'value' => Questions::getQuestionTitle($model->entity_id)]); ?>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]); ?>

    <?= $form->field($model, 'm_status')->dropDownList(\common\modules\community\models\QComments::getStatusDropDown()); ?>
    
    <?= $form->field($model, 'parent_id')->textInput(); ?>
    
    <?= $form->field($model, 'created_at')->textInput(['disabled'=>true]); ?>

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
                <i class="fa fa-thumbs-up" aria-hidden="true"></i> <?= is_null($model->likes) ? 0 : $model->likes; ?>
            </button>
            <button type="button" class="btn btn-danger">
                <i class="fa fa-thumbs-down" aria-hidden="true"></i> <?= is_null($model->dislikes) ? 0 : $model->dislikes; ?>
            </button>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
