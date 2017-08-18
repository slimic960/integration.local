<?php

namespace frontend\controllers;

use Yii;
use common\models\MappingCountryIdDvad;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Callcenter;
use common\models\MappingDeliveryServiceDvad;
use common\models\MappingOfferProductIdDvad;
use common\models\MappingProductIdDvad;
use common\models\MappingStatusesDvad;

/**
 * DvadController implements the CRUD actions for MappingCountryIdDvad model.
 */
class DvadController extends Controller
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
     * Lists all MappingCountryIdDvad models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProviderService = new ActiveDataProvider([
            'query' => MappingDeliveryServiceDvad::find(),
        ]);

        $dataProviderCountry = new ActiveDataProvider([
            'query' => MappingCountryIdDvad::find(),
        ]);

        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $id = \Yii::$app->request->get('id');
        $callcenter = callcenter::findOne($id);
        if($id == '3'){
            $query  = mappingcountryiddvad::find();
            $country_dvad = $query->orderBy('id')
                ->limit(50)
                ->all();
            $country_count_dvad = count($country_dvad);

            $query  = mappingdeliveryservicedvad::find();
            $service_dvad = $query->orderBy('id')
                ->limit(50)
                ->all();
            $service_count_dvad = count($service_dvad);

            $query  = mappingofferproductiddvad::find();
            $offer_dvad = $query->orderBy('id')
                ->limit(50)
                ->all();

            $query  = mappingproductiddvad::find();
            $product_dvad = $query->orderBy('id')
                ->limit(50)
                ->all();
            $product_count_dvad = count($product_dvad);

            $query  = mappingstatusesdvad::find();
            $status_dvad = $query->orderBy('id')
                ->limit(50)
                ->all();

            $model = new MappingDeliveryServiceDvad();
            $modelCountry = new MappingCountryIdDvad();

            if($model->load(\Yii::$app->request->post()) && $model->validate()){
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect(['index', 'id' => 3]);
                }
            }
            if($modelCountry->load(\Yii::$app->request->post()) && $modelCountry->validate()){
                if ($modelCountry->load(Yii::$app->request->post()) && $modelCountry->save()) {
                    return $this->redirect(['index', 'id' => $modelCountry->id]);
                }
            }


            return $this->render('index', compact(
                'callcenter',
                'country_dvad',
                'service_dvad',
                'offer_dvad',
                'product_dvad',
                'status_dvad',
                'country_count_dvad',
                'service_count_dvad',
                'product_count_dvad',
                'model',
                'modelCountry',
                'dataProviderCountry',
                'dataProviderService'
            ));
        }

    }

    /**
     * Displays a single MappingCountryIdDvad model.
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
     * Creates a new MappingCountryIdDvad model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MappingCountryIdDvad();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MappingCountryIdDvad model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MappingCountryIdDvad model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'id' => 3]);
    }

    /**
     * Finds the MappingCountryIdDvad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MappingCountryIdDvad the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MappingDeliveryServiceDvad::findOne($id)) !== null) {
            return $model;
        } elseif(($modelCountry = MappingCountryIdDvad::findOne($id)) !== null) {
                return $modelCountry;
             } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
