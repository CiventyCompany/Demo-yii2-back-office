<?php

use backend\modules\user\models\Profile;
use yii\widgets\ActiveForm;

/**
 * @var $userId
 * @var $status
 * @var $modalForm \backend\modules\user\models\ModalForm
 */

$status = $status ? 'true' : 'false';
?>
<!-- Modal -->
<div class="modal fade" id="delArchiveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><?= Yii::t('app','Enter reason for delete to archive user: ').'<br>'.Profile::getUserFullName($userId); ?></h4>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['action' => '/user/ajax/del-archive-user','id' => 'delArchForm', 'options' => ['class'=>'modalForm']]); ?>
                    <?= $form->field($modalForm,'cause')->textarea(['rows' => 15]); ?>
                    <?= $form->field($modalForm, 'userId')->hiddenInput(['value' => $userId])->label(false); ?>
                    <?= $form->field($modalForm, 'status')->hiddenInput(['value' => $status])->label(false); ?>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="modal-footer">
                <?= \yii\helpers\Html::submitButton(Yii::t('app', 'Send to archive'),['form' => 'delArchForm', 'class'=> 'btn btn-danger']); ?>

                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Yii::t('app', 'Cancel'); ?></button>
            </div>
        </div>
    </div>
</div>