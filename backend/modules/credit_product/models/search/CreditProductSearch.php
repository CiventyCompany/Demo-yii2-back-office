<?php

namespace backend\modules\credit_product\models\search;

use common\modules\credit_product\models\CreditProductCategory;
use common\modules\credit_product\models\CreditProductCategoryGroup;
use common\modules\credit_product\models\CreditProductCategoryHasProduct;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\credit_product\models\CreditProduct;

/**
 * CreditProductSearch represents the model behind the search form of `common\modules\credit_product\models\CreditProduct`.
 */
class CreditProductSearch extends CreditProduct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'rating', 'rating_reviews_count', 'sort', 'status'], 'integer'],
            [['title', 'text_short', 'text', 'created_at', 'alias', 'type_id'], 'safe'],
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
    public function search($params, $typeId = null)
    {
        $query = CreditProduct::find();
        if($typeId){
            $this->type_id = $typeId;
        }

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
            self::tableName() . '.id' => $this->id,
            self::tableName() . '.rating' => $this->rating,
            self::tableName() . '.rating_reviews_count' => $this->rating_reviews_count,
            self::tableName() . '.created_at' => $this->created_at,
            self::tableName() . '.sort' => $this->sort,
            self::tableName() . '.status' => $this->status,
        ]);

        if($this->type_id){
            $query->leftJoin( CreditProductCategoryHasProduct::tableName(), CreditProductCategoryHasProduct::tableName() . '.credit_product_id = ' . self::tableName() . '.id' );
            $query->leftJoin( CreditProductCategory::tableName(), CreditProductCategory::tableName() . '.id = ' . CreditProductCategoryHasProduct::tableName() . '.credit_product_category_id');
            $query->leftJoin( CreditProductCategoryGroup::tableName(), CreditProductCategoryGroup::tableName() . '.id = ' . CreditProductCategory::tableName() . '.credit_product_category_group_id' );
            $query->andWhere( CreditProductCategoryGroup::tableName() . '.credit_product_type_id = :type_id', ['type_id' => $this->type_id] );
            $query->groupBy( self::tableName() . '.id' );
        }

        $query->andFilterWhere(['like',  self::tableName() . '.title', $this->title])
            ->andFilterWhere(['like',  self::tableName() . '.text_short', $this->text_short])
            ->andFilterWhere(['like',  self::tableName() . '.text', $this->text])
            ->andFilterWhere(['like',  self::tableName() . '.alias', $this->alias]);

        return $dataProvider;
    }
}
