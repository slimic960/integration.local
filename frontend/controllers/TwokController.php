<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Callcenter;
use common\models\MappingOfferProductId2K;
use common\models\MappingOfferProductId2KSearch;
use common\models\MappingStatuses2K;
use common\models\MappingStatuses2KSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class TwokController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin','userTwok'],
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

        $searchModelOffer = new MappingOfferProductId2KSearch();
        $dataProviderOffer = $searchModelOffer->search(Yii::$app->request->queryParams);
        $dataProviderOffer->pagination->pageSize=150;

        $searchModelStatuses = new MappingStatuses2KSearch();
        $dataProviderStatuses = $searchModelStatuses->search(Yii::$app->request->queryParams);
        $dataProviderStatuses->pagination->pageSize=150;


        $id = \Yii::$app->request->get('id');
        $callcenter = callcenter::findOne($id);

        $query  = mappingofferproductid2k::find();
        $offer_2k = $query->orderBy('id')
            ->all();
        $offer_count_2k = count($offer_2k);

        $query  = mappingstatuses2k::find();
        $statuses_2k = $query->orderBy('id')
            ->all();
        $statuses_count_2k = count($statuses_2k);

        $modelOffers = new MappingOfferProductId2K();
        $modelStatuses = new MappingStatuses2K();

        if($modelOffers->load(\Yii::$app->request->post()) && $modelOffers->validate()){
            if ($modelOffers->load(Yii::$app->request->post()) && $modelOffers->save()) {
                return $this->redirect(['index']);
            }else {
                return $this->redirect(['index']);
            }
        }

        if($modelStatuses->load(\Yii::$app->request->post()) && $modelStatuses->validate()){
            if ($modelStatuses->load(Yii::$app->request->post()) && $modelStatuses->save()) {
                return $this->redirect(['index']);
            }else {
                return $this->redirect(['index']);
            }
        }


        return  $this->render('index', compact(
            'callcenter',
            'offer_count_2k',
            'statuses_count_2k',
            'modelOffers',
            'modelStatuses',
            'dataProviderOffer',
            'dataProviderStatuses',
            'searchModelOffer',
            'searchModelStatuses'
        ));
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
            ->update('callcenter_2K.mapping_offer_product_id', ['status_active' => 0], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionRedeleteOffer($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_2K.mapping_offer_product_id', ['status_active' => 1], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionDeleteStatuses($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_2K.mapping_statuses', ['status_terminal' => 0], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionRedeleteStatuses($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_2K.mapping_statuses', ['status_terminal' => 1], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    /**
     * Finds the MappingCountryIdDvad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MappingOfferProductId2K the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelOffer($id)
    {
        if (($modelOffer = MappingOfferProductId2K::findOne($id)) !== null) {
            return $modelOffer;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelStatuses($id)
    {
        if (($modelStatuses = MappingStatuses2K::findOne($id)) !== null) {
            return $modelStatuses;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
