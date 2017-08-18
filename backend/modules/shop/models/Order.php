<?php

namespace backend\modules\shop\models;

use common\modules\user\models\User;
use Yii;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $id
 * @property integer $user_id
 *
 * @property User $user
 * @property OrderItems[] $orderItems
 */
class Order extends \common\modules\shop\models\Order
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }
}
