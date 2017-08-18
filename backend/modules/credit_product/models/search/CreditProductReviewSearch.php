<?php

namespace backend\modules\credit_product\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\credit_product\models\CreditProductReview;

/**
 * CreditProductReviewSearch represents the model behind the search form of `common\modules\credit_product\models\CreditProductReview`.
 */
class CreditProductReviewSearch extends CreditProductReview
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'credit_product_id', 'user_id', 'rating', 'likes_count', 'dislikes_count', 'comments_count', 'status'], 'integer'],
            [['title', 'text', 'created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $attributeLabels = parent::attributeLabels();
        $attributeLabels['user_id'] = Yii::t('app', 'User');
        return $attributeLabels;
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
        $query = CreditProductReview::find();

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
            'credit_product_id' => $this->credit_product_id,
            'user_id' => $this->user_id,
            'rating' => $this->rating,
            'likes_count' => $this->likes_count,
            'dislikes_count' => $this->dislikes_count,
            'comments_count' => $this->comments_count,
            'created_at' => $this->created_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
