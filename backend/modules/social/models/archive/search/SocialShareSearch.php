<?php

namespace backend\modules\social\models\archive\search;

use backend\modules\social\models\archive\SocialShare;
use common\helpers\DBHelper;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class SocialShareSearch extends SocialShare
{
    public $post_id, $social_name, $user_id, $created_at, $fullName, $id;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['social_name', 'post_id', 'created_at', 'fullName'], 'string'],
            [['user_id', 'id'], 'integer']
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
     * @param $user \backend\modules\user\models\User
     *
     * @return ActiveDataProvider
     */
    public function search($params, $user = null)
    {
        $db = DBHelper::getDbName('db');
        $query = SocialShare::find();

        if(isset($user)){
            $query->where(['social_share.user_id' => $user->id]);
        }

        $query->leftJoin($db . '.social_share_settings', $db . '.social_share_settings.social_id = social_share.social_id')
            ->joinWith('profile');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes'=>[
                'id'=>[
                    'asc'=>['id' => SORT_ASC],
                    'desc'=>['id' => SORT_DESC],
                ],
                'user_id'=>[
                    'asc'=>['user_id' => SORT_ASC],
                    'desc'=>['user_id' => SORT_DESC],
                ],
                'social_name' => [
                    'asc'=>[$db . '.social_share_settings.social_name'=>SORT_ASC],
                    'desc'=>[$db . '.social_share_settings.social_name'=>SORT_DESC],
                ],
                'fullName'=>[
                    'asc'=>['profile.midlename'=>SORT_ASC, 'profile.lastname'=>SORT_ASC, 'profile.firstname'=>SORT_ASC],
                    'desc'=>['profile.midlename'=>SORT_DESC, 'profile.lastname'=>SORT_DESC, 'profile.firstname'=>SORT_DESC],
                ],
                'created_at' => [
                    'asc'=>['created_at'=>SORT_ASC],
                    'desc'=>['created_at'=>SORT_DESC],
                ],
                'post_id' => [
                    'asc'=>['post_id' => SORT_ASC],
                    'desc'=>['post_id' => SORT_DESC],
                ],
            ]
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', $db . '.social_share_settings.social_name', $this->social_name])
             ->andFilterWhere(['like', 'social_share.post_id', $this->post_id])
             ->andFilterWhere(['social_share.user_id' => $this->user_id])

            ->andFilterWhere(['like', 'profile.midlename', $this->fullName])
            ->orFilterWhere(['like', 'profile.firstname', $this->fullName])
            ->orFilterWhere(['like', 'profile.lastname', $this->fullName])
            ->andFilterWhere(['id' => $this->id]);

        if(isset($this->created_at) && !empty($this->created_at)) {
            $start = strtotime('-1 day', strtotime($this->created_at));
            $end = strtotime('+1 day', strtotime($this->created_at));
            $query->andFilterWhere(['between', 'social_share.created_at', $start, $end]);
        }

        return $dataProvider;
    }
}
