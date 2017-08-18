<?php

use backend\modules\user\models\Profile;
use yii\widgets\ActiveForm;

/**
 * @var $userId
 * @var $modalBalanceForm \common\modules\user\models\UserBalance
 */

?>
<!-- Modal -->
<div class="modal fade" id="balanceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><?= Yii::t('app','Refill balance to user: ').'<br>'.Profile::getUserFullName($userId); ?></h4>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['action' => '/user/ajax/refill-balance', 'id' => 'balanceForm', 'options' => ['class'=>'modalForm']]); ?>
                    <?= $form->field($modalBalanceForm,'local')->input('number'); ?>
                    <?= $form->field($modalBalanceForm,'external')->input('number'); ?>
                    <?= $form->field($modalBalanceForm, 'user_id')->hiddenInput(['value' => $userId])->label(false); ?>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="modal-footer">
                <?= \yii\helpers\Html::submitButton(Yii::t('app', 'Update balance'),['form' => 'balanceForm', 'class'=> 'btn btn-success']); ?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Yii::t('app', 'Cancel'); ?></button>
            </div>
        </div>
    </div>
</div>