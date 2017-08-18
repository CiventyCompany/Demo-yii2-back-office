<li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        <?php if(count($models) > 0): ?>
            <span class="label label-warning"><?= $count; ?></span>
        <?php endif; ?>
    </a>
    <?php if(count($models) > 0 ): ?>

        <ul class="dropdown-menu">
            <li class="header"><?= Yii::t('app','You have '); ?><?= $count; ?><?= Yii::t('app',' notifications'); ?></li>
            <li>
                <ul class="menu">
                    <?php foreach ($models as $model): ?>
                        <li>
                            <a href="/app_interface/notifications/update?id=<?= $model->notification_id; ?>">
                                <i class="fa fa-envelope text-yellow"></i>
                                <?= $model->value; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li class="footer"><a href="/app_interface/notifications/index"><?= Yii::t('app','View all'); ?></a></li>
        </ul>
    <?php else: ?>
        <ul class="dropdown-menu">
            <li class="header"><?= Yii::t('app','You haven\'t new notifications'); ?></li>
        </ul>
    <?php endif; ?>
</li>
