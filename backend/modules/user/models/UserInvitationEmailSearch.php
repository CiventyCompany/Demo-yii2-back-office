<?php

namespace backend\modules\user\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class UserInvitationEmailSearch extends UserInvitationEmail
{
    public $user_id, $firstname, $firstname_user, $created_at, $email, $status;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'status'], 'integer'],
            [['firstname', 'firstname_user', 'created_at', 'email'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $userId = null)
    {
        $query = UserInvitationEmail::find()->joinWith('user');

        if($userId){
            $query->andWhere(['user_invitation_email.user_id' => $userId]);
        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes'=>[
                'firstname'=>[
                    'asc'=>['user_invitation_email.firstname' => SORT_ASC],
                    'desc'=>['user_invitation_email.firstname' => SORT_DESC],
                ],
                'user_id'=>[
                    'asc'=>['user_invitation_email.user_id' => SORT_ASC],
                    'desc'=>['user_invitation_email.user_id' => SORT_DESC],
                ],
                'email'=>[
                    'asc'=>['user_invitation_email.email' => SORT_ASC],
                    'desc'=>['user_invitation_email.email' => SORT_DESC],
                ],
                'created_at'=>[
                    'asc'=>['user_invitation_email.created_at' => SORT_ASC],
                    'desc'=>['user_invitation_email.created_at' => SORT_DESC],
                ],
                'status'=>[
                    'asc'=>['user_invitation_email.status' => SORT_ASC],
                    'desc'=>['user_invitation_email.status' => SORT_DESC],
                ],
                'firstname_user'=>[
                    'asc'=>['profile.midlename'=>SORT_ASC, 'profile.lastname'=>SORT_ASC, 'profile.firstname'=>SORT_ASC],
                    'desc'=>['profile.midlename'=>SORT_DESC, 'profile.lastname'=>SORT_DESC, 'profile.firstname'=>SORT_DESC],
                ],
            ]
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'user_invitation_email.firstname', $this->firstname])
            ->andFilterWhere(['user_invitation_email.user_id' => $this->user_id])
            ->andFilterWhere(['like', 'user_invitation_email.email', $this->email]);

            if($this->created_at) {
                $query->orFilterWhere(['like',
                    'user_invitation_email.created_at',
                    date("Y-m-d", strtotime($this->created_at))
                ]);
            }

        $query->andFilterWhere(['user_invitation_email.status' => $this->status])

            ->andFilterWhere(['like', 'profile.midlename', $this->firstname_user])
            ->orFilterWhere(['like', 'profile.firstname', $this->firstname_user])
            ->orFilterWhere(['like', 'profile.lastname', $this->firstname_user]);


        return $dataProvider;
    }
}