<?php
namespace backend\modules\user\models;

use common\modules\user\models\UserAvatar;
use Yii;
use yii\data\ActiveDataProvider;

class UserAvatarSearch extends UserAvatar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['old_avatar_id', 'status', 'avatar'], 'safe'],
        ];
    }

    public function search($params, $user_id)
    {
        $query = self::find()->where(['user_id' => $user_id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes'=>[
                    'id',
                    'status',
                    'moderation_status',
                    'old_avatar_id',
                ],
                'defaultOrder'=> ['id' => SORT_DESC],
            ]
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['status' => $this->status])
            ->andFilterWhere(['moderation_status' => $this->moderation_status])
            ->andFilterWhere(['old_avatar_id' => $this->old_avatar_id]);

        return $dataProvider;
    }

    public function getStatuses()
    {
        return [
            self::STATUS_NOT_ACTIVE => Yii::t('app', 'Not active'),
            self::STATUS_ACTIVE => Yii::t('app', 'Active'),
        ];
    }

    public function getModerationStatuses()
    {
        return [
            self::MODERATION_STATUS_NEW => Yii::t('app', 'New'),
            self::MODERATION_STATUS_PASSED => Yii::t('app', 'Passed'),
            self::MODERATION_STATUS_NOT_PASSED => Yii::t('app', 'Not Passed'),
        ];
    }
}
