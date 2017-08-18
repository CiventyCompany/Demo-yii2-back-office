<?php

namespace backend\modules\app_interface\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\app_interface\models\Notifications;

/**
 * NotificationsSearch represents the model behind the search form of `\common\modules\app_interface\models\Notifications`.
 */
class NotificationsSearch extends Notifications
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notification_id', 'key','entity_id','mark'], 'integer'],
            [['entity', 'value', 'created_at', 'user_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Notifications::find()
            ->joinWith('profile');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query
            ->andFilterWhere(['like', 'profile.midlename', $this->user_id])
            ->orFilterWhere(['like', 'profile.firstname', $this->user_id])
            ->orFilterWhere(['like', 'profile.lastname', $this->user_id]);

        // grid filtering conditions
        $query->andFilterWhere([
            'notification_id' => $this->notification_id,
            'entity_id' => $this->entity_id,
            'created_at'  => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'entity', $this->entity])
            ->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'mark', $this->mark])
            ->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}
