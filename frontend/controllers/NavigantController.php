<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Callcenter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
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
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'index',
                    'delete-offer', 'redelete-offer',
                    'offer-update'
                ],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin','viewIndexNavigant'],
                    ],
                    [
                        'actions' => [
                            'delete-offer', 'redelete-offer',
                            'offer-update'
                        ],
                        'allow' => true,
                        'roles' => ['admin','editIndexNavigant'],
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

        $searchModelOffer = new MappingOfferNavigantSearch();
        $dataProviderOffer = $searchModelOffer->search(Yii::$app->request->queryParams);
        $dataProviderOffer->pagination->pageSize=150;

        $id = \Yii::$app->request->get('id');
        $callcenter = callcenter::findOne($id);

        $query  = mappingoffernavigant::find();
        $offer_by = $query->orderBy('id')
            ->all();
        $offer_count_navigant = count($offer_by);

        $modelOffers = new MappingOfferNavigant();

        $this->actionOffersCreate($modelOffers);

        return  $this->render('index', compact(
            'callcenter',
            'offer_count_navigant',
            'modelOffers',
            'dataProviderOffer',
            'searchModelOffer'
        ));
    }

    public function actionOffersCreate($modelOffers)
    {
        if($modelOffers->load(\Yii::$app->request->post()) && $modelOffers->validate()){
            if (Yii::$app->user->can('editIndexNavigant')) {
                if ($modelOffers->load(Yii::$app->request->post()) && $modelOffers->save()) {
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
