<?php
namespace backend\modules\credit_rating\controllers;

use common\modules\credit_rating\models\CreditRatingHistory;
use common\modules\credit_rating\models\CreditRatingHistoryFieldPriority;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;


/**
 * NewsController implements the CRUD actions for News model.
 */
class PrioritiesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all
     * @return mixed
     */
    public function actionIndex()
    {
        $data = [];
        $fields = CreditRatingHistoryFieldPriority::getFields();
        foreach ($fields as $field => $label){
            $data[$field] = [
                'label' => $label,
                'models' => CreditRatingHistoryFieldPriority::find()->where(['field' => $field])->orderBy(['priority' => SORT_DESC])->all(),
            ];
        }

        return $this->render('index', [
            'data' => $data,
        ]);
    }

    /**
     * Update all
     * @return mixed
     */
    public function actionUpdate( $field )
    {
        $postData = Yii::$app->request->post('CreditRatingHistoryFieldPriority');
        if(Yii::$app->request->isPost && $postData){
            $models = $values = [];
            for ($i = 0; $i < count($postData['model']); $i++){
                $models[] = $postData['model'][$i];
                $values[] = implode("','", [$field, str_replace('\\', '\\\\', $postData['model'][$i]), $postData['priority'][$i]]);
            }
            if(count($models)){
                Yii::$app->db->createCommand("DELETE FROM " . CreditRatingHistoryFieldPriority::tableName() . " WHERE field = '{$field}' AND  model NOT IN('" . implode("','", $models) ."');")->execute();
            }
            if(count($values)){
                Yii::$app->db->createCommand("INSERT INTO " . CreditRatingHistoryFieldPriority::tableName() . " (field, model, priority) VALUES ('" . implode("'),('", $values) . "') ON DUPLICATE KEY UPDATE priority = VALUES(priority);")->execute();
            }
        }

        $data = [];
        $models = CreditRatingHistory::getModels();
        foreach ($models as $model => $label){
            $modelItem = new $model();
            if(!$modelItem->hasAttribute($field)){
                continue;
            }
            $creditRatingHistoryFieldPriority = CreditRatingHistoryFieldPriority::find()->where(['field' => $field, 'model' => $model])->one();
            $data[] = [
                'model' => $model,
                'label' => $label,
                'priority' => $creditRatingHistoryFieldPriority ? $creditRatingHistoryFieldPriority->priority : 0,
            ];
        }
        return $this->render('update', ['data' => $data, 'field' => $field, 'model' => new CreditRatingHistoryFieldPriority()]);
    }

}
