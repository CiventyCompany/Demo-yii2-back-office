<?php

namespace backend\modules\credit_product\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\credit_product\models\CreditProductField;

/**
 * CreditProductFieldSearch represents the model behind the search form of `common\modules\credit_product\models\CreditProductField`.
 */
class CreditProductFieldSearch extends CreditProductField
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'credit_product_type_id', 'show_in', 'multiple', 'multiple_count', 'show_place', 'sort', 'status'], 'integer'],
            [['name', 'suffix', 'type', 'alias'], 'safe'],
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
    public function search($params, $typeId)
    {
        $query = CreditProductField::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'sort' => SORT_ASC,
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andWhere(['credit_product_type_id' => $typeId]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'show_in' => $this->show_in,
            'multiple' => $this->multiple,
            'multiple_count' => $this->multiple_count,
            'show_place' => $this->show_place,
            'sort' => $this->sort,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'suffix', $this->suffix])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'alias', $this->alias]);

        return $dataProvider;
    }
}
