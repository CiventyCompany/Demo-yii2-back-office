<?php
namespace backend\modules\event\controllers;

use backend\modules\event\models\EventHandler;
use backend\modules\event\models\search\EventActionSearch;
use backend\modules\event\models\search\EventSearch;
use Yii;
use yii\web\Controller;

/**
 * EventActionController implements the CRUD actions for EventAction model.
 */
class EventController extends Controller
{
    /**
     * Lists all EventAction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search( Yii::$app->request->queryParams );
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all EventAction models.
     * @return mixed
     */
    public function actionUpdate($model, $event_name)
    {
        $searchModel = new EventActionSearch();
        $searchModel->model = $model;
        $searchModel->event_name = $event_name;
        $eventHandler = new EventHandler();
        $dataProvider = $searchModel->search( Yii::$app->request->queryParams );
        return $this->render('update', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'eventHandler' => $eventHandler,
        ]);
    }
}
