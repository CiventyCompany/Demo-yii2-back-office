<?php
use backend\modules\user\models\UserRecoveryLog;
/* @var $this yii\web\View */
/* @var $model \backend\modules\user\models\UserRecoveryLog */

?>
<div class="btn-group">
    <p>Изменить статус на:</p>
    <?php
    foreach ($model->getStatusText( 'moderation' ) as $status => $label){
        switch ($status){
            case UserRecoveryLog::STATUS_MODERATION_COMPLETED:
                $class = 'btn-success';
                break;
            case UserRecoveryLog::STATUS_MODERATION_FAIL:
                $class = 'btn-danger';
                break;
            default:
                $class = 'btn-warning';
                break;
        }

        if($model->status == $status){
            $class .= ' active focus';
        }

        echo \yii\helpers\Html::a( $label, ['/user/recovery/set-status', 'id' => $model->id, 'status' => $status], [
            'class' => 'btn ' . $class,
        ]);
    }
    ?>
</div>
<hr />