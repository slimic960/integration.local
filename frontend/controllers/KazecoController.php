<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Callcenter;
use common\models\MappingCountryKazeco;
use common\models\MappingCountryKazecoSearch;
use common\models\MappingDeliveryServiceKazeco;
use common\models\MappingDeliveryServiceKazecoSearch;
use common\models\MappingOfferKazeco;
use common\models\MappingOfferKazecoSearch;
use common\models\MappingOfferProductKazeco;
use common\models\MappingOfferProductKazecoSearch;
use common\models\MappingStatusesKazeco;
use common\models\MappingStatusesKazecoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class KazecoController extends Controller
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
                    'delete-country', 'redelete-country', 'delete-service', 'redelete-service', 'delete-offer', 'redelete-offer',
                    'delete-offer-product', 'redelete-offer-product', 'delete-statuses', 'redelete-statuses',
                    'country-update', 'service-update', 'offer-update', 'offer-product-update', 'statuses-update'
                ],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin','viewIndexKazeco'],
                    ],
                    [
                        'actions' => [
                            'delete-country', 'redelete-country', 'delete-service', 'redelete-service', 'delete-offer', 'redelete-offer',
                            'delete-offer-product', 'redelete-offer-product', 'delete-statuses', 'redelete-statuses',
                            'country-update', 'service-update', 'offer-update', 'offer-product-update', 'statuses-update'
                        ],
                        'allow' => true,
                        'roles' => ['admin','editIndexKazeco'],
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
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $searchModelCountry = new MappingCountryKazecoSearch();
        $dataProviderCountry = $searchModelCountry->search(Yii::$app->request->queryParams);
        $dataProviderCountry->pagination->pageSize=150;

        $searchModelService = new MappingDeliveryServiceKazecoSearch();
        $dataProviderService = $searchModelService->search(Yii::$app->request->queryParams);
        $dataProviderService->pagination->pageSize=150;


        $searchModelOffer = new MappingOfferKazecoSearch();
        $dataProviderOffer = $searchModelOffer->search(Yii::$app->request->queryParams);
        $dataProviderOffer->pagination->pageSize=150;

        $searchModelOfferProduct = new MappingOfferProductKazecoSearch();
        $dataProviderOfferProduct = $searchModelOfferProduct->search(Yii::$app->request->queryParams);
        $dataProviderOfferProduct->pagination->pageSize=150;

        $searchModelStatuses = new MappingStatusesKazecoSearch();
        $dataProviderStatuses = $searchModelStatuses->search(Yii::$app->request->queryParams);
        $dataProviderStatuses->pagination->pageSize=150;



        $id = \Yii::$app->request->get('id');
        $callcenter = callcenter::findOne($id);

        $query  = mappingcountrykazeco::find();
        $country_kazeco = $query->orderBy('id')
            ->all();
        $country_count_kazeco = count($country_kazeco);

        $query  = mappingdeliveryservicekazeco::find();
        $service_kazeco = $query->orderBy('id')
            ->all();
        $service_count_kazeco = count($service_kazeco);

        $query  = mappingofferkazeco::find();
        $offer_kazeco = $query->orderBy('id')
            ->all();
        $offer_count_kazeco = count($offer_kazeco);

        $query  = mappingofferproductkazeco::find();
        $offer_product_kazeco = $query->orderBy('id')
            ->all();
        $offer_product_count_kazeco = count($offer_product_kazeco);

        $query  = mappingstatuseskazeco::find();
        $statuses_kazeco = $query->orderBy('id')
            ->all();
        $statuses_count_kazeco = count($statuses_kazeco);

        $modelCountry = new MappingCountryKazeco();
        $modelService = new MappingDeliveryServiceKazeco();
        $modelOffer = new MappingOfferKazeco();
        $modelOfferProduct = new MappingOfferProductKazeco();
        $modelStatuses = new MappingStatusesKazeco();

        $this->actionCountryCreate($modelCountry);
        $this->actionServiceCreate($modelService);
        $this->actionOfferCreate($modelOffer);
        $this->actionOfferProductCreate($modelOfferProduct);
        $this->actionStatusesCreate($modelStatuses);


        return  $this->render('index', compact(
            'callcenter',
            'country_count_kazeco',
            'service_count_kazeco',
            'offer_count_kazeco',
            'offer_product_count_kazeco',
            'statuses_count_kazeco',
            'modelCountry',
            'modelService',
            'modelOffer',
            'modelOfferProduct',
            'modelStatuses',
            'dataProviderCountry',
            'dataProviderService',
            'dataProviderOffer',
            'dataProviderOfferProduct',
            'dataProviderStatuses',
            'searchModelCountry',
            'searchModelService',
            'searchModelOffer',
            'searchModelOfferProduct',
            'searchModelStatuses'
        ));
    }

    public function actionCountryCreate($modelCountry)
    {
        if($modelCountry->load(\Yii::$app->request->post()) && $modelCountry->validate()){
            if (Yii::$app->user->can('editIndexKazeco')) {
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

    public function actionServiceCreate($modelService)
    {
        if($modelService->load(\Yii::$app->request->post()) && $modelService->validate()){
            if (Yii::$app->user->can('editIndexKazeco')) {
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

    public function actionOfferCreate($modelOffer)
    {
        if($modelOffer->load(\Yii::$app->request->post()) && $modelOffer->validate()){
            if (Yii::$app->user->can('editIndexKazeco')) {
                if ($modelOffer->load(Yii::$app->request->post()) && $modelOffer->save()) {
                    return $this->redirect(['index']);
                } else {
                    return $this->redirect(['index']);
                }
            }else {
                throw new ForbiddenHttpException('Вам не разрешено производить данное действие.');
            }
        }

    }

    public function actionOfferProductCreate($modelOfferProduct)
    {
        if($modelOfferProduct->load(\Yii::$app->request->post()) && $modelOfferProduct->validate()){
            if (Yii::$app->user->can('editIndexKazeco')) {
                if ($modelOfferProduct->load(Yii::$app->request->post()) && $modelOfferProduct->save()) {
                    return $this->redirect(['index']);
                } else {
                    return $this->redirect(['index']);
                }
            }else {
                throw new ForbiddenHttpException('Вам не разрешено производить данное действие.');
            }
        }
    }

    public function actionStatusesCreate($modelStatuses)
    {
        if($modelStatuses->load(\Yii::$app->request->post()) && $modelStatuses->validate()){
            if (Yii::$app->user->can('editIndexKazeco')) {
                if ($modelStatuses->load(Yii::$app->request->post()) && $modelStatuses->save()) {
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

    public function actionOfferUpdate($id)
    {
        $modelOffer = $this->findModelOffer($id);
        if ($modelOffer->load(Yii::$app->request->post()) && $modelOffer->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('offerUpdate', [
                'modelOffer' => $modelOffer,
            ]);
        }
    }

    public function actionOfferProductUpdate($id)
    {
        $modelOfferProduct = $this->findModelOfferProduct($id);
        if ($modelOfferProduct->load(Yii::$app->request->post()) && $modelOfferProduct->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('offerProductUpdate', [
                'modelOfferProduct' => $modelOfferProduct,
            ]);
        }
    }

    public function actionStatusesUpdate($id)
    {
        $modelStatuses = $this->findModelStatuses($id);
        if ($modelStatuses->load(Yii::$app->request->post()) && $modelStatuses->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('statusesUpdate', [
                'modelStatuses' => $modelStatuses,
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
            ->update('callcenter_kazeco.mapping_country', ['status_active' => 0], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionRedeleteCountry($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_kazeco.mapping_country', ['status_active' => 1], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionDeleteService($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_kazeco.mapping_delivery_service', ['status_active' => 0], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionRedeleteService($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_kazeco.mapping_delivery_service', ['status_active' => 1], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionDeleteOffer($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_kazeco.mapping_offer', ['active' => 0], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionRedeleteOffer($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_kazeco.mapping_offer', ['active' => 1], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionDeleteOfferProduct($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_kazeco.mapping_offer_product', ['active' => 0], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionRedeleteOfferProduct($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_kazeco.mapping_offer_product', ['active' => 1], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionDeleteStatuses($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_kazeco.mapping_statuses', ['status_terminal' => 0], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionRedeleteStatuses($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_kazeco.mapping_statuses', ['status_terminal' => 1], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }



    /**
     * Finds the MappingCountryIdDvad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MappingCountryKazeco the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelCountry($id)
    {
        if (($modelCountry = MappingCountryKazeco::findOne($id)) !== null) {
            return $modelCountry;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelService($id)
    {
        if (($modelService = MappingDeliveryServiceKazeco::findOne($id)) !== null) {
            return $modelService;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelOffer($id)
    {
        if (($modelOffer = MappingOfferKazeco::findOne($id)) !== null) {
            return $modelOffer;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelOfferProduct($id)
    {
        if (($modelOfferProduct = MappingOfferProductKazeco::findOne($id)) !== null) {
            return $modelOfferProduct;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelStatuses($id)
    {
        if (($modelStatuses = MappingStatusesKazeco::findOne($id)) !== null) {
            return $modelStatuses;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
