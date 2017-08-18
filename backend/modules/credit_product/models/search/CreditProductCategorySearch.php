<?php

namespace backend\modules\credit_product\models\search;

use common\modules\credit_product\models\CreditProductCategoryGroup;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\credit_product\models\CreditProductCategory;

/**
 * CreditProductCategorySearch represents the model behind the search form of `common\modules\credit_product\models\CreditProductCategory`.
 */
class CreditProductCategorySearch extends CreditProductCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'credit_product_category_group_id', 'parent_id', 'sort', 'status'], 'integer'],
            [['title', 'alias'], 'safe'],
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
        $query = CreditProductCategory::find();

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

        $query->leftJoin( CreditProductCategoryGroup::tableName(), CreditProductCategoryGroup::tableName() . '.id = ' . self::tableName() . '.credit_product_category_group_id' );
        $query->andWhere( CreditProductCategoryGroup::tableName() . '.credit_product_type_id = ' . $typeId );

        // grid filtering conditions
        $query->andFilterWhere([
            self::tableName() . '.id' => $this->id,
            self::tableName() . '.credit_product_category_group_id' => $this->credit_product_category_group_id,
            self::tableName() . '.parent_id' => $this->parent_id,
            self::tableName() . '.sort' => $this->sort,
            self::tableName() . '.status' => $this->status,
        ]);

        $query->andFilterWhere(['like', self::tableName() . '.title', $this->title])
            ->andFilterWhere(['like', self::tableName() . '.alias', $this->alias]);

        return $dataProvider;
    }
}
