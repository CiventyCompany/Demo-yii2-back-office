<?php

namespace backend\modules\user\models\query;

/**
 * This is the ActiveQuery class for [[\common\modules\user\models\UserRegisterLog]].
 *
 * @see \common\modules\user\models\UserRegisterLog
 */
class UserRegisterLogQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\modules\user\models\UserRegisterLog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\modules\user\models\UserRegisterLog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
