<?php

namespace backend\modules\event\controllers;

use backend\modules\event\models\EventHandler;
use Yii;
use backend\modules\event\models\EventAction;
use backend\modules\event\models\search\EventActionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * EventActionController implements the CRUD actions for EventAction model.
 */
class EventActionController extends Controller
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
     * Creates a new EventAction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate( $modelName, $eventName )
    {
        $model = new EventAction();
        $model->model = $modelName;
        $model->event_name = $eventName;
        $model->status = 1;
        $eventHandler = new EventHandler();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/event/event/update', 'model' => $model->model, 'event_name' => $model->event_name]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'eventHandler' => $eventHandler,
            ]);
        }
    }

    /**
     * Updates an existing EventAction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $eventHandler = new EventHandler();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/event/event/update', 'model' => $model->model, 'event_name' => $model->event_name]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'eventHandler' => $eventHandler,
            ]);
        }
    }

    /**
     * Deletes an existing EventAction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['/event/event/update', 'model' => $model->model, 'event_name' => $model->event_name]);
    }

    /**
     * @param $modelName
     * @return array
     */
    public function actionGetModelSettings( $modelName )
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new EventAction();
        return [
            'status' => 'ok',
            'html' => $model->getModelSettings($modelName)
        ];
    }

    /**
     * Finds the EventAction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EventAction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EventAction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
