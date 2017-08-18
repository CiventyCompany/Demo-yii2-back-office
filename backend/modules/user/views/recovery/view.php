<?php
use backend\modules\user\models\UserRecoveryLog;

/* @var $this yii\web\View */
/* @var $model \backend\modules\user\models\UserRecoveryLog */


$this->title = 'Восстановление доступа №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Recovery'), 'url' => ['/user/recovery/index']];
$this->params['breadcrumbs'][] = $this->title;
$visibleBlocks = json_decode( $model->visible );
$user = $model->getUser();
?>
<?php if( in_array($model->status, [
    UserRecoveryLog::STATUS_MODERATION,
    UserRecoveryLog::STATUS_MODERATION_IN_PROCESS,
    UserRecoveryLog::STATUS_MODERATION_FAIL,
    UserRecoveryLog::STATUS_MODERATION_COMPLETED
]) ){
    echo $this->render('_buttons', ['model' => $model]);
} ?>

<table class="table table-striped table-bordered detail-view">
    <tbody>
        <tr>
            <th style="width: 30%;"><?= Yii::t('app', 'ID') ?></th>
            <td><?= $model->id ?></td>
        </tr>
        <tr>
            <th style="width: 30%;"><?= Yii::t('app', 'Status') ?></th>
            <td><?= $model->getStatusLabel() ?></td>
        </tr>
        <tr>
            <th style="width: 30%;"><?= Yii::t('app', 'User') ?></th>
            <td><?= is_object( $user ) ? \yii\helpers\Html::a( $user->profile->getFullName(), ['/user/registered/view', 'id' => $user->id] ) : '-' ?></td>
        </tr>
        <?php foreach ($model->getSortFields() as $logData){ ?>
        <tr>
            <th style="width: 30%;"><?= $logData->getLabel() ?></th>
            <td><?= $model->getDataLabel( $logData->getValue() ) ?> <?= $logData->getValidLabel() ?></td>
        </tr>
        <?php } ?>
        <tr>
            <th style="width: 30%;"><?= Yii::t('app', 'Filling Steps') ?></th>
            <td>
                <ol>
                    <?php foreach ($visibleBlocks as $block){ ?>
                    <li>
                        <?= $model->getDataLabel( $block ) ?>
                    </li>
                <?php } ?>
                </ol>
            </td>
        </tr>
        <tr>
            <th style="width: 30%;"><?= Yii::t('app', 'Browser data') ?></th>
            <td><?= \backend\modules\user\helpers\UserDataHelper::getBrowserData($model) ?></td>
        </tr>
        <tr>
            <th style="width: 30%;"><?= Yii::t('app', 'Created At') ?></th>
            <td><?= $model->created_at ?></td>
        </tr>
        <tr>
            <th style="width: 30%;"><?= Yii::t('app', 'Updated At') ?></th>
            <td><?= $model->updated_at ?></td>
        </tr>
    </tbody>
</table>