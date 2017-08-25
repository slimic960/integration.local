<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Callcenter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\MappingOfferNavigant;
use common\models\MappingOfferNavigantSearch;
class NavigantController extends Controller
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
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $searchModelOffer = new MappingOfferNavigantSearch();
        $dataProviderOffer = $searchModelOffer->search(Yii::$app->request->queryParams);
        $dataProviderOffer->pagination->pageSize=15;

        $id = \Yii::$app->request->get('id');
        $callcenter = callcenter::findOne($id);

        $query  = mappingoffernavigant::find();
        $offer_by = $query->orderBy('id')
            ->limit(50)
            ->all();
        $offer_count_navigant = count($offer_by);

        $modelOffers = new MappingOfferNavigant();

        if($modelOffers->load(\Yii::$app->request->post()) && $modelOffers->validate()){
            if ($modelOffers->load(Yii::$app->request->post()) && $modelOffers->save()) {
                return $this->redirect(['index']);
            }else {
                return $this->redirect(['index']);
            }
        }

        return  $this->render('index', compact(
            'callcenter',
            'offer_count_navigant',
            'modelOffers',
            'dataProviderOffer',
            'searchModelOffer'
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


    /**
     * Deletes an existing MappingCountryIdDvad model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteOffer($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_navigant.mapping_offer', ['active' => 0], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }

    public function actionRedeleteOffer($id)
    {
        Yii::$app->db->createCommand()
            ->update('callcenter_navigant.mapping_offer', ['active' => 1], ['id' => $id])
            ->execute();
        return $this->redirect(['index']);
    }


    /**
     * Finds the MappingCountryIdDvad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MappingOfferNavigant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelOffer($id)
    {
        if (($modelOffer = MappingOfferNavigant::findOne($id)) !== null) {
            return $modelOffer;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
