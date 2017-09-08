<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Callcenter;
use common\models\MappingOffersBY;
use common\models\MappingOffersBYSearch;
use common\models\MappingStatusesBY;
use common\models\MappingStatusesBYSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;


/**
 * BYController implements the CRUD actions for MappingOffersBY model.
 */
class ByController extends Controller
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
                    'delete-offer', 'redelete-offer', 'delete-statuses', 'redelete-statuses',
                    'offer-update', 'statuses-update'
                ],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin','viewIndexBy'],
                    ],
                    [
                        'actions' => [
                            'delete-offer', 'redelete-offer', 'delete-statuses', 'redelete-statuses',
                            'offer-update', 'statuses-update'
                        ],
                        'allow' => true,
                        'roles' => ['admin','editIndexBy'],
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

        $searchModelOffer = new MappingOffersBYSearch();
        $dataProviderOffer = $searchModelOffer->search(Yii::$app->request->queryParams);
        $dataProviderOffer->pagination->pageSize=150;

        $searchModelStatuses = new MappingStatusesBYSearch();
        $dataProviderStatuses = $searchModelStatuses->search(Yii::$app->request->queryParams);
        $dataProviderStatuses->pagination->pageSize=150;

        $id = \Yii::$app->request->get('id');
        $callcenter = callcenter::findOne($id);

        $query  = mappingoffersbysearch::find();
        $offer_by = $query->orderBy('id')
            ->all();
        $offer_count_by = count($offer_by);

        $query  = mappingstatusesby::find();
        $statuses_by = $query->orderBy('id')
            ->all();
        $statuses_count_by = count($statuses_by);

        $modelOffers = new MappingOffersBY();
        $modelStatuses = new MappingStatusesBY();

        $this->actionOfferCreate($modelOffers);
        $this->actionStatusesCreate($modelStatuses);


        return  $this->render('index', compact(
            'callcenter',
            'offer_count_by',
            'statuses_count_by',
            'modelOffers',
            'modelStatuses',
            'dataProviderOffer',
            'dataProviderStatuses',
            'searchModelOffer',
            'searchModelStatuses'
        ));
    }


    public function actionOfferCreate($modelOffers)
    {
            if($modelOffers->load(\Yii::$app->request->post()) && $modelOffers->validate()){
                if (Yii::$app->user->can('editIndexBy')) {
                if ($modelOffers->load(Yii::$app->request->post()) && $modelOffers->save()) {
                    return $this->redirect(['index']);
                }else{
                    return $this->redirect(['index']);
                }
            }else {
                    throw new ForbiddenHttpException('Вам не разрешено производить данное действие.');
                }
        }
    }

    public function actionStatusesCreate($modelStatuses)
    {
        if($modelStatuses->load(\Yii::$app->request->post()) && $modelStatuses->validate()) {
            if (Yii::$app->user->can('editIndexBy')) {
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
    public function actionOfferUpdate($id)
    {
        $modelOffers = $this->findModelOffer($id);
        if ($modelOffers->load(Yii::$app->request->post()) && $modelOffers->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('offerUpdate', [
                'modelOffers' => $modelOffers,
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
    public function actionDeleteOffer($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_BY.mapping_offers', ['active' => 0], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionRedeleteOffer($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_BY.mapping_offers', ['active' => 1], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionDeleteStatuses($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_BY.mapping_statuses', ['status_terminal' => 0], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionRedeleteStatuses($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_BY.mapping_statuses', ['status_terminal' => 1], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }


    /**
     * Finds the MappingCountryIdDvad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MappingOffersBY the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelOffer($id)
    {
        if (($modelOffer = MappingOffersBY::findOne($id)) !== null) {
            return $modelOffer;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelStatuses($id)
    {
        if (($modelStatuses = MappingStatusesBY::findOne($id)) !== null) {
            return $modelStatuses;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



}
