<?php
namespace backend\modules\app_interface\controllers;

use common\modules\app_interface\models\Message;
use common\modules\app_interface\models\SourceMessageSearch;
use Yii;
use common\modules\app_interface\models\SourceMessage;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * DefaultController implements the CRUD actions for SourceMessage model.
 */
class DefaultController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all SourceMessage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SourceMessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    /**
     * Displays a single SourceMessage model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = SourceMessage::find()->where(['source_message.id' => $id])->joinWith('messages')->all();

        if($model) {
            return $this->render('view', [
                'model' => $model,
            ]);
        }else{
            return $this->redirect('index');
        }
    }

    /**
     * Creates a new SourceMessage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SourceMessage();
        $messages = new Message();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $messages->load(Yii::$app->request->post());
            foreach($messages->translation as $langKey => $langValue){
                $mess = new Message();
                $mess->translation = $langValue;
                $mess->language = $langKey;
                $mess->id = $model->id;
                $mess->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'messages' => $messages
            ]);
        }
    }

    /**
     * Updates an existing SourceMessage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $messages = Message::find()->where(['id' => $model->id])->all();
        $messages = ArrayHelper::index($messages,'language');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $tempMess = new Message();
            $tempMess->load(Yii::$app->request->post());
            foreach($tempMess->translation as $langKey => $langValue){
                if(key_exists($langKey, $messages)){
                    $messages[$langKey]->translation = $langValue;
                    $messages[$langKey]->save();
                } else {
                    $mess = new Message();
                    $mess->translation = $langValue;
                    $mess->language = $langKey;
                    $mess->id = $model->id;
                    $mess->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'messages' => $messages
            ]);
        }
    }

    /**
     * Deletes an existing SourceMessage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SourceMessage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SourceMessage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SourceMessage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
