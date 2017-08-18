<?php

namespace backend\modules\export\controllers;

use backend\modules\export\models\search\ExportQueueSearch;
use common\helpers\ClassHelper;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Yii;
use backend\modules\export\models\ExportQueue;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ExportQueueController implements the CRUD actions for ExportQueue model.
 */
class ExportQueueController extends Controller
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
     * Lists all ExportQueue models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExportQueueSearch();
        $dataProvider = $searchModel->search( Yii::$app->request->get() );

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ExportQueue model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ExportQueue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ExportQueue();
        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post( ClassHelper::getClassName( $model ) );
            $className = ClassHelper::getClassName( $model->model );
            if( array_key_exists($className, $data) ){
                $model->settings = $data[ $className ];
            }
            if( $model->save() ){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ExportQueue model.
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
     * @param $model
     * @return array
     */
    public function actionGetModelSettings( $model )
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = [
            'status' => 'ok',
            'html' => '',
        ];

        if( strlen($model) ){
            $modelName = ClassHelper::getClassName( $model );
            $out['html'] = $this->renderPartial('model-settings/'.$modelName, [
                'fieldNamePrefix' => "ExportQueue[{$modelName}]",
                'model' => new $model(),
            ]);
        }

        return $out;
    }

    /**
     * @param $id
     * @return array
     */
    public function actionCheck( $id )
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);
        if( $model->status == $model::STATUS_COMPLETED ){
            return [
                'status' => 'ok',
                'html' => Html::a(Yii::t('app', 'Download'), ['download', 'id' => $model->id])
            ];
        }
        return [
            'status' => 'fail'
        ];
    }

    /**
     * @param $id
     * @return $this
     * @throws FileNotFoundException
     */
    public function actionDownload( $id )
    {
        $model = $this->findModel($id);
        if( strlen($model->file_name) && file_exists($model->getFilePath()) ){
            if($model->status == $model::STATUS_COMPLETED){
                $model->updateAttributes(['status' => $model::STATUS_DOWNLOADED]);
            }
            return Yii::$app->response->sendFile( $model->getFilePath() );
        }
        throw new FileNotFoundException( Yii::t('app', 'File not found') );
    }

    /**
     * Finds the ExportQueue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ExportQueue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ExportQueue::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
