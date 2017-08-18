<?php

namespace backend\modules\credit_product\models\search;

use backend\modules\user\models\Profile;
use backend\modules\user\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\credit_product\models\CreditProductReviewComment;

/**
 * CreditProductReviewCommentSearch represents the model behind the search form of `common\modules\credit_product\models\CreditProductReviewComment`.
 */
class CreditProductReviewCommentSearch extends CreditProductReviewComment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'credit_product_review_id', 'likes_count', 'dislikes_count', 'status'], 'integer'],
            [['text', 'created_at', 'user_id'], 'safe'],
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
        $query = CreditProductReviewComment::find();

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

        if($this->user_id){
            $query->leftJoin( User::tableName(), User::tableName() . '.id = ' . self::tableName() . '.user_id' );
            $query->leftJoin( Profile::tableName(), Profile::tableName() . '.user_id = ' . User::tableName() . '.id' );
            $query->andWhere("CONCAT_WS(' ', " . Profile::tableName() . ".firstname, " . Profile::tableName() . ".midlename, " . Profile::tableName() . ".lastname) LIKE '{$this->user_id}%'");
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'credit_product_review_id' => $this->credit_product_review_id,
            'likes_count' => $this->likes_count,
            'dislikes_count' => $this->dislikes_count,
            'created_at' => $this->created_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
