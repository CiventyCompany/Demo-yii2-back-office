<?php
namespace backend\modules\user\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use Yii;

class UserTransactionsSearch extends UserTransactions
{
    public $fullName, $id, $status, $price, $title, $created_at, $description;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            ['price', 'string'],
            [['title', 'created_at', 'description', 'fullName'], 'string']
        ];
    }

    public function attributeLabels()
    {
        return parent::attributeLabels()['fullName'] = Yii::t('app', 'Full name');
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
    public function search($params)
    {
        $query = UserTransactions::find()->joinWith('profile');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes'=>[
                'id'=>[
                    'asc'=>['user_transaction.id' => SORT_ASC],
                    'desc'=>['user_transaction.id' => SORT_DESC],
                ],
                'price'=>[
                    'asc'=>['user_transaction.price' => SORT_ASC],
                    'desc'=>['user_transaction.price' => SORT_DESC],
                ],
                'title'=>[
                    'asc'=>['user_transaction.title' => SORT_ASC],
                    'desc'=>['user_transaction.title' => SORT_DESC],
                ],
                'created_at'=>[
                    'asc'=>['user_transaction.created_at' => SORT_ASC],
                    'desc'=>['user_transaction.created_at' => SORT_DESC],
                ],
                'status'=>[
                    'asc'=>['user_transaction.status' => SORT_ASC],
                    'desc'=>['user_transaction.status' => SORT_DESC],
                ],
                'description'=>[
                    'asc'=>['user_transaction.description' => SORT_ASC],
                    'desc'=>['user_transaction.description' => SORT_DESC],
                ],
                'fullName'=>[
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


        $query->andFilterWhere(['like', 'profile.midlename', $this->fullName])
            ->orFilterWhere(['like', 'profile.firstname', $this->fullName])
            ->orFilterWhere(['like', 'profile.lastname', $this->fullName])

            ->andFilterWhere(['user_transaction.id' => $this->id])
            ->andFilterWhere(['like', 'user_transaction.price', $this->price])
            ->andFilterWhere(['like', 'user_transaction.title', $this->title])
            ->andFilterWhere(['like', 'user_transaction.created_at', $this->created_at])
            ->andFilterWhere(['like', 'user_transaction.description', $this->description])
            ->andFilterWhere(['user_transaction.status' => $this->status]);


        return $dataProvider;
    }
}
