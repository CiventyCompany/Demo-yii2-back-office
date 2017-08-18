<?php

/**
 * @var $userId
 * @var $statuses
 */

$frozen     = $statuses['frozen'];
$blocked    = $statuses['blocked'];
$delArchive = $statuses['delArchive'];
$delStatus  = $statuses['delStatus'];
?>
<div class="btn-group user-action-btns col-md-12" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-success" onclick="window.location.href='/user/registered/update?id=<?= $userId; ?>'">
        <?= Yii::t('app','Edit'); ?>
    </button>


    <button type="button" id="logInToFront" class="btn btn-info" data-userId="<?= $userId; ?>">
        <?= Yii::t('app','Login on frontend'); ?>
    </button>



    <?php if($frozen): ?>
        <button type="button" class="btn btn-success freeze" data-status="true" data-userId="<?= $userId; ?>">
            <?= Yii::t('app','Unfreeze'); ?>
        </button>
    <?php else: ?>
        <button type="button" class="btn btn-warning" data-status="false" data-userId="<?= $userId; ?>" data-toggle="modal" data-target="#frezedModal">
            <?= Yii::t('app','Freeze'); ?>
        </button>
    <?php endif;?>



    <?php if($blocked): ?>
        <button type="button" class="btn btn-success block" data-status="true" data-userId="<?= $userId; ?>">
            <?= Yii::t('app','Unblock'); ?>
        </button>
    <?php else: ?>
        <button type="button" class="btn btn-danger" data-userId="<?= $userId; ?>" data-toggle="modal" data-target="#blockedModal">
            <?= Yii::t('app','Block'); ?>
        </button>
    <?php endif;?>



<!--    --><?php //if($delArchive): ?>
<!--        <button type="button" class="btn btn-success" data-userId="--><?//= $userId; ?><!--">-->
<!--            --><?php //Yii::t('app','Restore (Restore from archive)'); ?>
<!--        </button>-->
<!--    --><?php //else: ?>
<!--        <button type="button" class="btn btn-danger" data-userId="--><?//= $userId; ?><!--" data-toggle="modal" data-target="#delArchiveModal">-->
<!--            --><?php //Yii::t('app','Delete (Sent to archive)'); ?>
<!--        </button>-->
<!--    --><?php //endif;?>



    <?php if($delStatus): ?>
        <button type="button" class="btn btn-success delStatus" data-status="true" data-userId="<?= $userId; ?>">
            <?= Yii::t('app','Restore (Change status)'); ?>
        </button>
    <?php else: ?>
        <button type="button" class="btn btn-danger" data-status="false" data-userId="<?= $userId; ?>" data-toggle="modal" data-target="#delStatusModal">
            <?= Yii::t('app','Delete (Set status)'); ?>
        </button>
    <?php endif;?>



</div>