<?php

namespace backend\modules\community\controllers;

use common\modules\community\models\Questions;
use Yii;
use common\modules\community\models\QComments;
use backend\modules\community\models\QCommentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QCommentsController implements the CRUD actions for QComments model.
 */
class QCommentsController extends Controller
{
    /**
     * Lists all QComments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QCommentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new QComments model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new QComments();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing QComments model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing QComments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $subComments = QComments::find()
            ->where(['entity' => Questions::className()])
            ->andWhere(['parent_id' => $id])
            ->all();
        foreach ($subComments as $subComment){
            $subComment->delete();
        }
        $model = $this->findModel($id);
        $q_model = Questions::findOne(['question_id' => $model->entity_id]);
        $q_model->comments_count--;
        $q_model->save();

        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the QComments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QComments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QComments::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
