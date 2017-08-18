<?php

namespace backend\modules\community\models;


use frontend\modules\news\models\News;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\community\models\QComments;

/**
 * QCommentsSearch represents the model behind the search form of `\common\modules\community\models\QComments`.
 */
class QCommentsSearch extends QComments
{
    public $created_at;
    public $entityModel;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['commentary_id',  'parent_id', 'likes', 'dislikes', 'm_status'], 'integer'],
            [['title', 'body', 'created_at', 'entity_id', 'user_id'], 'safe'],
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
        $query = QComments::find()
            ->joinWith('profile')
            ->joinWith('questions');

        if(!is_null($this->entityModel)){
            $query->where(['entity' => $this->entityModel]);
        }else{
            $query->where(['not',['entity' => News::className()]]);

        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query
            ->andFilterWhere(['like', 'profile.midlename', $this->user_id])
            ->orFilterWhere(['like', 'profile.firstname', $this->user_id])
            ->orFilterWhere(['like', 'profile.lastname', $this->user_id])

            ->andFilterWhere(['like', 'questions.title', $this->entity_id]);

        if(isset($this->created_at) && !empty($this->created_at)) {
            $start = strtotime('-1 day', strtotime($this->created_at));
            $end = strtotime('+1 day', strtotime($this->created_at));
            $start = date('Y-m-d H:i:s', $start);
            $end   = date('Y-m-d H:i:s', $end);
            $query->andFilterWhere(['between', 'q_comments.created_at', $start, $end]);
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'commentary_id' => $this->commentary_id,
            'parent_id' => $this->parent_id,
            'likes' => $this->likes,
            'dislikes' => $this->dislikes,
            'm_status' => $this->m_status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'body', $this->body]);

        return $dataProvider;
    }
}
