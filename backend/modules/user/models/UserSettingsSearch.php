<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 25.07.16
 * Time: 18:25
 */

namespace backend\modules\user\models;

use Yii;
use common\modules\user\models\UserSettings;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class UserSettingsSearch extends UserSettings
{
    public function rules()
    {
        return [
            [['name', 'value'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return parent::attributeLabels();
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param $model object
     *
     * @return ActiveDataProvider
     */
    public function search($params, $model = null)
    {
        $query = self::find()->where(['user_id' => $model->id])->andWhere(['IN', 'name', array_keys(self::getSubscribeSettings())]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $this->load($params, '');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }


    public static function getSubscribeSettings()
    {
        return [
            'SubscribeGetAllNotificationsToEmail' => Yii::t('app', 'Get copies of all mail notifications'),
            'SubscribeNews' => Yii::t('app', 'Notify me about news'),
            'SubscribeArticles' => Yii::t('app', 'I want to know if there is a new article'),
        ];
    }
}