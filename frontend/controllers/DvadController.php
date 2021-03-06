<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\Callcenter;
use common\models\MappingCountryIdDvad;
use common\models\MappingDeliveryServiceDvad;
use common\models\MappingOfferProductIdDvad;
use common\models\MappingProductIdDvad;
use common\models\MappingCountryIdDvadSearch;
use common\models\MappingDeliveryServiceDvadSearch;
use common\models\MappingOfferProductIdDvadSearch;
use common\models\MappingProductIdDvadSearch;


class DvadController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'index',
                    'delete-country', 'redelete-country', 'delete-service', 'redelete-service', 'delete-offerid', 'redelete-offerid',
                    'delete-productid', 'redelete-productid',
                    'country-update', 'service-update', 'offerid-update', 'product-update'
                ],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin','viewIndexDvad'],
                    ],
                    [
                        'actions' => [
                            'delete-country', 'redelete-country', 'delete-service', 'redelete-service', 'delete-offerid', 'redelete-offerid',
                            'delete-productid', 'redelete-productid',
                            'country-update', 'service-update', 'offerid-update', 'product-update'
                        ],
                        'allow' => true,
                        'roles' => ['admin','editIndexDvad'],
                    ],
                ],
            ],
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

        $searchModelCountry = new MappingCountryIdDvadSearch();
        $dataProviderCountry = $searchModelCountry->search(Yii::$app->request->queryParams);
        $dataProviderCountry->pagination->pageSize=150;

        $searchModelService = new MappingDeliveryServiceDvadSearch();
        $dataProviderService = $searchModelService->search(Yii::$app->request->queryParams);
        $dataProviderService->pagination->pageSize=150;

        $searchModelOfferId = new MappingOfferProductIdDvadSearch();
        $dataProviderOfferId = $searchModelOfferId->search(Yii::$app->request->queryParams);
        $dataProviderOfferId->pagination->pageSize=150;

        $searchModelProductId = new MappingProductIdDvadSearch();
        $dataProviderProductId = $searchModelProductId->search(Yii::$app->request->queryParams);
        $dataProviderProductId->pagination->pageSize=150;


        if (Yii::$app->user->isGuest) {
                return $this->goHome();
            }
            $id = \Yii::$app->request->get('id');
            $callcenter = callcenter::findOne($id);

            $query  = mappingcountryiddvad::find();
            $country_dvad = $query->orderBy('id')
                ->all();
            $country_count_dvad = count($country_dvad);

            $query  = mappingdeliveryservicedvad::find();
            $service_dvad = $query->orderBy('id')
                ->all();
            $service_count_dvad = count($service_dvad);

            $query  = mappingofferproductiddvad::find();
            $offer_dvad = $query->orderBy('id')
                ->all();
            $offer_count_dvad = count($offer_dvad);

            $query  = mappingproductiddvad::find();
            $product_dvad = $query->orderBy('id')
                ->all();
            $product_count_dvad = count($product_dvad);

            $modelService = new MappingDeliveryServiceDvad();
            $modelCountry = new MappingCountryIdDvad();
            $modelOfferId = new MappingOfferProductIdDvad();
            $modelProductId = new MappingProductIdDvad();

            $this->actionServiceCreate($modelService);
            $this->actionCountryCreate($modelCountry);
            $this->actionOfferidCreate($modelOfferId);
            $this->actionProductCreate($modelProductId);

            return  $this->render('index', compact(
                'callcenter',
                'country_count_dvad',
                'service_count_dvad',
                'product_count_dvad',
                'offer_count_dvad',
                'modelService',
                'modelCountry',
                'modelOfferId',
                'modelProductId',
                'dataProviderCountry',
                'dataProviderService',
                'dataProviderOfferId',
                'dataProviderProductId',
                'searchModelCountry',
                'searchModelService',
                'searchModelOfferId',
                'searchModelProductId'
            ));
    }


    public function actionServiceCreate($modelService)
    {
        if($modelService->load(\Yii::$app->request->post()) && $modelService->validate()){
            if (Yii::$app->user->can('editIndexDvad')) {
                if ($modelService->load(Yii::$app->request->post()) && $modelService->save()) {
                    return $this->redirect(['index']);
                } else {
                    return $this->redirect(['index']);
                }
            }else {
                throw new ForbiddenHttpException('Вам не разрешено производить данное действие.');
            }
        }
    }

    public function actionCountryCreate($modelCountry)
    {
        if($modelCountry->load(\Yii::$app->request->post()) && $modelCountry->validate()){
            if (Yii::$app->user->can('editIndexDvad')) {
                if ($modelCountry->load(Yii::$app->request->post()) && $modelCountry->save()) {
                    return $this->redirect(['index']);
                } else {
                    return $this->redirect(['index']);
                }
            }else {
                throw new ForbiddenHttpException('Вам не разрешено производить данное действие.');
            }
        }
    }

    public function actionOfferidCreate($modelOfferId)
    {
        if($modelOfferId->load(\Yii::$app->request->post()) && $modelOfferId->validate()){
            if (Yii::$app->user->can('editIndexDvad')) {
                if ($modelOfferId->load(Yii::$app->request->post()) && $modelOfferId->save()) {
                    return $this->redirect(['index']);
                } else {
                    return $this->redirect(['index']);
                }
            }else {
                throw new ForbiddenHttpException('Вам не разрешено производить данное действие.');
            }
        }
    }

    public function actionProductCreate($modelProductId)
    {
        if($modelProductId->load(\Yii::$app->request->post()) && $modelProductId->validate()){
            if (Yii::$app->user->can('editIndexDvad')) {
                if ($modelProductId->load(Yii::$app->request->post()) && $modelProductId->save()) {
                    return $this->redirect(['index']);
                } else {
                    return $this->redirect(['index']);
                }
            }else {
                throw new ForbiddenHttpException('Вам не разрешено производить данное действие.');
            }
        }
    }

    /**
     * Updates an existing MappingCountryIdDvad model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionCountryUpdate($id)
    {
        $modelCountry = $this->findModelCountry($id);
        if ($modelCountry->load(Yii::$app->request->post()) && $modelCountry->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('countryUpdate', [
                'modelCountry' => $modelCountry,
            ]);
        }
    }

    public function actionServiceUpdate($id)
    {
        $modelService = $this->findModelService($id);
        if ($modelService->load(Yii::$app->request->post()) && $modelService->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('serviceUpdate', [
                'modelService' => $modelService,
            ]);
        }
    }

    public function actionOfferidUpdate($id)
    {
        $modelOfferId = $this->findModelOfferid($id);
        if ($modelOfferId->load(Yii::$app->request->post()) && $modelOfferId->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('offeridUpdate', [
                'modelOfferId' => $modelOfferId,
            ]);
        }
    }

    public function actionProductUpdate($id)
    {
        $modelProductId = $this->findModelProductid($id);
        if ($modelProductId->load(Yii::$app->request->post()) && $modelProductId->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('productUpdate', [
                'modelProductId' => $modelProductId,
            ]);
        }
    }


    /**
     * Deletes an existing MappingCountryIdDvad model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteCountry($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_dvad.mapping_country_id', ['status_active' => 0], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionRedeleteCountry($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_dvad.mapping_country_id', ['status_active' => 1], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionDeleteService($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_dvad.mapping_delivery_service', ['status_active' => 0], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionRedeleteService($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_dvad.mapping_delivery_service', ['status_active' => 1], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionDeleteOfferid($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_dvad.mapping_offer_product_id', ['active' => 0], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionRedeleteOfferid($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_dvad.mapping_offer_product_id', ['active' => 1], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionDeleteProductid($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_dvad.mapping_product_id', ['status_active' => 0], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionRedeleteProductid($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_dvad.mapping_product_id', ['status_active' => 1], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }


    /**
     * Finds the MappingCountryIdDvad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MappingCountryIdDvad the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelService($id)
    {
        if (($modelService = MappingDeliveryServiceDvad::findOne($id)) !== null) {
                return $modelService;
        } else {
        throw new NotFoundHttpException('The requested page does not exist.');
         }
    }


    protected function findModelCountry($id)
    {
        if(($modelCountry = MappingCountryIdDvad::findOne($id)) !== null) {
            return $modelCountry;
        }else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelOfferid($id)
    {
        if(($modelOfferId = MappingOfferProductIdDvad::findOne($id)) !== null) {
            return $modelOfferId;
        }else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelProductid($id)
    {
        if(($modelProductId = MappingProductIdDvad::findOne($id)) !== null) {
            return $modelProductId;
        }else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



}
