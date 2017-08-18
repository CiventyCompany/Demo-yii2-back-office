<?php

namespace backend\modules\event\models\search;

use backend\modules\event\models\EventAction;
use common\modules\event\models\EventActionCondition;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * EventActionSearch represents the model behind the search form of `common\modules\event\models\EventAction`.
 */
class EventActionSearch extends EventAction
{
    public $has_conditions;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model', 'event_name', 'handler_model', 'status', 'priority', 'title', 'description', 'has_conditions'], 'safe'],
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
        $query = EventAction::find()->groupBy('event_action.id');

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
            'event_action.id' => $this->id,
            'event_action.status' => $this->status,
            'event_action.priority' => $this->priority,
        ]);


        $this->has_conditions = intval( $this->has_conditions );
        if( $this->has_conditions != 0 ){
            $query->leftJoin( EventActionCondition::tableName() . ' eac', 'eac.event_action_id = event_action.id' );
            if( $this->has_conditions > 0 ){
                $query->andWhere('eac.event_action_id IS NOT NULL');
            } else {
                $query->andWhere('eac.event_action_id IS NULL');
            }
        }

        $query
            ->andFilterWhere(['like', 'event_action.title', $this->title])
            ->andFilterWhere(['like', 'event_action.description', $this->description])
            ->andFilterWhere(['like', 'event_action.model', $this->model, false])
            ->andFilterWhere(['like', 'event_action.event_name', $this->event_name, false])
            ->andFilterWhere(['like', 'event_action.handler_model', $this->handler_model, false]);

        return $dataProvider;
    }
}
