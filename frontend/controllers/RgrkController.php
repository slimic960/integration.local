<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Callcenter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\MappingStatusesRgrk;
use common\models\MappingStatusesRgrkSearch;
use common\models\MappingCountryRgrk;
use common\models\MappingCountryRgrkSearch;
use common\models\MappingOfferProductRgrk;
use common\models\MappingOfferProductRgrkSearch;
class RgrkController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'index',
                    'delete-country', 'redelete-country', 'delete-offer-product', 'redelete-offer-product', 'delete-statuses', 'redelete-statuses',
                    'country-update', 'offer-product-update', 'statuses-update'
                ],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin','viewIndexRgrk'],
                    ],
                    [
                        'actions' => [
                            'delete-country', 'redelete-country', 'delete-offer-product', 'redelete-offer-product', 'delete-statuses', 'redelete-statuses',
                            'country-update', 'offer-product-update', 'statuses-update'
                        ],
                        'allow' => true,
                        'roles' => ['admin','editIndexRgrk'],
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

        $searchModelCountry = new MappingCountryRgrkSearch();
        $dataProviderCountry = $searchModelCountry->search(Yii::$app->request->queryParams);
        $dataProviderCountry->pagination->pageSize=150;

        $searchModelOfferProduct = new MappingOfferProductRgrkSearch();
        $dataProviderOfferProduct = $searchModelOfferProduct->search(Yii::$app->request->queryParams);
        $dataProviderOfferProduct->pagination->pageSize=150;

        $searchModelStatuses = new MappingStatusesRgrkSearch();
        $dataProviderStatuses = $searchModelStatuses->search(Yii::$app->request->queryParams);
        $dataProviderStatuses->pagination->pageSize=150;


        $id = \Yii::$app->request->get('id');
        $callcenter = callcenter::findOne($id);

        $query  = mappingcountryrgrk::find();
        $country_rgrk = $query->orderBy('id')
            ->all();
        $country_count_rgrk = count($country_rgrk);

        $query  = mappingofferproductrgrk::find();
        $offer_product_rgrk = $query->orderBy('id')
            ->all();
        $offer_product_count_rgrk = count($offer_product_rgrk);

        $query  = mappingstatusesrgrk::find();
        $statuses_rgrk = $query->orderBy('id')
            ->all();
        $statuses_count_rgrk = count($statuses_rgrk);

        $modelCountry = new MappingCountryRgrk();
        $modelOfferProduct = new MappingOfferProductRgrk();
        $modelStatuses = new MappingStatusesRgrk();

        $this->actionCountryCreate($modelCountry);
        $this->actionOfferProductCreate($modelOfferProduct);
        $this->actionStatusesCreate($modelStatuses);

        return  $this->render('index', compact(
            'callcenter',
            'country_count_rgrk',
            'offer_product_count_rgrk',
            'statuses_count_rgrk',
            'modelCountry',
            'modelOfferProduct',
            'modelStatuses',
            'dataProviderCountry',
            'dataProviderOfferProduct',
            'dataProviderStatuses',
            'searchModelCountry',
            'searchModelOfferProduct',
            'searchModelStatuses'
        ));
    }

    public function actionCountryCreate($modelCountry)
    {
        if($modelCountry->load(\Yii::$app->request->post()) && $modelCountry->validate()){
            if (Yii::$app->user->can('editIndexRgrk')) {
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

    public function actionOfferProductCreate($modelOfferProduct)
    {
        if($modelOfferProduct->load(\Yii::$app->request->post()) && $modelOfferProduct->validate()){
            if (Yii::$app->user->can('editIndexRgrk')) {
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
            if (Yii::$app->user->can('editIndexRgrk')) {
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
            ->update('callcenter_rgrk.mapping_country', ['status_active' => 0], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionRedeleteCountry($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_rgrk.mapping_country', ['status_active' => 1], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionDeleteOfferProduct($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_rgrk.mapping_offer_product', ['status_active' => 0], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }


    public function actionRedeleteOfferProduct($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_rgrk.mapping_offer_product', ['status_active' => 1], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionDeleteStatuses($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_rgrk.mapping_statuses', ['status_terminal' => 0], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionRedeleteStatuses($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_rgrk.mapping_statuses', ['status_terminal' => 1], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }



    /**
     * Finds the MappingCountryIdDvad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MappingCountryRgrk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelCountry($id)
    {
        if (($modelCountry = MappingCountryRgrk::findOne($id)) !== null) {
            return $modelCountry;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelOfferProduct($id)
    {
        if (($modelOfferProduct = MappingOfferProductRgrk::findOne($id)) !== null) {
            return $modelOfferProduct;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelStatuses($id)
    {
        if (($modelStatuses = MappingStatusesRgrk::findOne($id)) !== null) {
            return $modelStatuses;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
