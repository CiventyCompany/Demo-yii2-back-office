<?php

namespace backend\modules\event\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\event\models\EventActionCondition;

/**
 * EventActionConditionSearch represents the model behind the search form of `common\modules\event\models\EventActionCondition`.
 */
class EventActionConditionSearch extends EventActionCondition
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'event_action_id'], 'integer'],
            [['key', 'value', 'operator'], 'safe'],
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
    public function search($params, $event_action_id = null)
    {
        $query = EventActionCondition::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'event_action_id' => $this->event_action_id,
        ]);

        $query->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'operator', $this->operator]);

        return $dataProvider;
    }
}
