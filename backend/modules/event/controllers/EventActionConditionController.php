<?php

namespace backend\modules\event\controllers;

use backend\modules\event\models\EventAction;
use backend\modules\event\models\EventHandler;
use Yii;
use common\modules\event\models\EventActionCondition;
use backend\modules\event\models\search\EventActionConditionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventActionConditionController implements the CRUD actions for EventActionCondition model.
 */
class EventActionConditionController extends Controller
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
     * Lists all EventActionCondition models.
     * @return mixed
     */
    public function actionIndex( $event_action_id )
    {
        $searchModel = new EventActionConditionSearch();
        $eventAction = EventAction::findOne( $event_action_id );
        $searchModel->event_action_id = $event_action_id;
        $dataProvider = $searchModel->search( Yii::$app->request->queryParams, $event_action_id );
        $eventHandler = new EventHandler();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'eventAction' => $eventAction,
            'eventHandler' => $eventHandler,
        ]);
    }

    /**
     * Creates a new EventActionCondition model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate( $event_action_id )
    {
        $model = new EventActionCondition();
        $model->event_action_id = $event_action_id;
        $eventAction = EventAction::findOne( $model->event_action_id );
        $eventHandler = new EventHandler();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/event/event-action-condition/index', 'event_action_id' => $model->event_action_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'eventAction' => $eventAction,
                'eventHandler' => $eventHandler,
            ]);
        }
    }

    /**
     * Updates an existing EventActionCondition model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $eventAction = EventAction::findOne( $model->event_action_id );
        $eventHandler = new EventHandler();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/event/event-action-condition/index', 'event_action_id' => $model->event_action_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'eventAction' => $eventAction,
                'eventHandler' => $eventHandler,
            ]);
        }
    }

    /**
     * Deletes an existing EventActionCondition model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['/event/event-action-condition/index', 'event_action_id' => $model->event_action_id]);
    }

    /**
     * Finds the EventActionCondition model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EventActionCondition the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EventActionCondition::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
