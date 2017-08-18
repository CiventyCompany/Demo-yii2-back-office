<?php

namespace backend\modules\credit_product\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\credit_product\models\CreditProductReferenceValues;

/**
 * CreditProductReferenceValuesSearch represents the model behind the search form of `common\modules\credit_product\models\CreditProductReferenceValues`.
 */
class CreditProductReferenceValuesSearch extends CreditProductReferenceValues
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'credit_product_reference_id', 'sort'], 'integer'],
            [['value'], 'safe'],
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
    public function search($params, $credit_product_reference_id = null)
    {
        $query = CreditProductReferenceValues::find();

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

        if($credit_product_reference_id){
            $this->credit_product_reference_id = $credit_product_reference_id;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'credit_product_reference_id' => $this->credit_product_reference_id,
            'sort' => $this->sort,
        ]);

        $query->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}
