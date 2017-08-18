<?php

namespace backend\modules\api\controllers;

use backend\modules\api\models\PartnerFields;
use backend\modules\user\models\Profile;
use backend\modules\user\models\User;
use Yii;
use backend\modules\api\models\Partners;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * PartnersController implements the CRUD actions for Partners model.
 */
class PartnersController extends Controller
{
    /**
     * Lists all Partners models.
     * @return mixed
     */
    public function actionIndex()
    {

        $dataProvider = new ActiveDataProvider([
            'query' => Partners::find(),
            //'sort'=> ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Render view with links to application swagger api
     * @return string
     */
    public function actionApi()
    {
        return $this->render('api_page',[
            'link_app'      => Yii::$app->params['link_app'],
            'link_partners' => Yii::$app->params['link_partners']
        ]);
    }

    /**
     * Displays a single Partners model.
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
     * Creates a new Partners model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $partner = new Partners();
        $user    = new User();
        $fields  = new PartnerFields();
        $fieldsData  = Yii::$app->request->post('PartnerFields');

        if ($user->load(Yii::$app->request->post())) {
            $isValid = $user->validate();
            if ($isValid) {
                $user->email = $user->username;
                $user->save(false);
                $partner->user_id = $user->id;
                $partner->generateToken();
                PartnerFields::saveFields($partner->id, $fieldsData);
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'partner' => $partner,
            'user'    => $user,
            'fields'  => $fields
        ]);

    }

    /**
     * Updates an existing Partners model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $partner = $this->findModel($id);
        $user    = User::findOne(['id' => $partner->user_id]);
        $fields  = PartnerFields::findAll(['partner_id' => $partner->id]);
        $fieldsData  = Yii::$app->request->post('PartnerFields');


        if ($user->load(Yii::$app->request->post())) {
            $user->save(false);

            $partner->load(Yii::$app->request->post());
            $partner->save();

            PartnerFields::saveFields($id, $fieldsData);

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'partner' => $partner,
                'user'    => $user,
                'fields'  => $fields
            ]);
        }
    }

    /**
     * Deletes an existing Partners model and its relations
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        PartnerFields::deleteAll(['partner_id' => $id]);
        $user = User::findOne(['id' => $model->user_id]);
        $user->delete();
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Partners model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Partners the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Partners::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Regenerate unique partner access token for api
     * @return array
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     */
    public function actionRegenToken()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if(Yii::$app->request->isAjax){
            $id = Yii::$app->request->post('id');
            $model = Partners::findOne($id);
            if(!$model){
               throw new NotFoundHttpException('Partner model not found.');
            }

            $model->generateToken();

            return [
                'res' => 'ok',
                'token' => $model->access_token
            ];
        }

        throw new BadRequestHttpException('Only ajax is allowed.');
    }

    /**
     * Regenerate unique partner access token for api
     * @return array
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     */
    public function actionBan()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if(Yii::$app->request->isAjax){
            $id = Yii::$app->request->post('id');
            $model = Partners::findOne($id);
            if(!$model){
                throw new NotFoundHttpException('Partner model not found.');
            }

            $model->access_token = '';
            $model->save();
            return [
                'res'     => 'ok',
                'banText' => 'Заблокирован'
            ];
        }

        throw new BadRequestHttpException('Only ajax is allowed.');
    }
}
