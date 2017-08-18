<?php
namespace backend\modules\common\models\search;

use backend\modules\common\models\ReferenceBookValues;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ReferenceBookValuesSearch represents the model behind the search form of ReferenceBookValues
 */
class ReferenceBookValuesSearch extends ReferenceBookValues
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'safe'],
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
    public function search($params, $reference_book_id)
    {
        $query = self::find()->where(['reference_book_id' => $reference_book_id]);

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


        $query
            ->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}
