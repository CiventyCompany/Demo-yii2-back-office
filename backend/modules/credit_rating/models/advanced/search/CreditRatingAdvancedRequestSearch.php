<?php

namespace backend\modules\credit_rating\models\advanced\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\credit_rating\models\advanced\CreditRatingAdvancedRequest;

/**
 * CreditRatingAdvancedRequestSearch represents the model behind the search form of `common\modules\credit_rating\models\CreditRatingAdvancedRequest`.
 */
class CreditRatingAdvancedRequestSearch extends CreditRatingAdvancedRequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status', 'order_id'], 'integer'],
            [['model', 'created_at', 'base_file_name', 'completed_at'], 'safe'],
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
        $query = CreditRatingAdvancedRequest::find();

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
            'user_id' => $this->user_id,
            'order_id' => $this->order_id,
            'created_at' => $this->created_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'base_file_name', $this->base_file_name]);

        return $dataProvider;
    }
}
