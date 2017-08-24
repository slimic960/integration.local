<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Callcenter;
use common\models\MappingCountryKazeco;
use common\models\MappingCountryKazecoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class KazecoController extends \yii\web\Controller
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

        $searchModelCountry = new MappingCountryKazecoSearch();
        $dataProviderCountry = $searchModelCountry->search(Yii::$app->request->queryParams);

        $id = \Yii::$app->request->get('id');
        $callcenter = callcenter::findOne($id);

        $query  = mappingcountrykazeco::find();
        $country_by = $query->orderBy('id')
            ->limit(50)
            ->all();
        $country_count_by = count($country_by);

        $modelCountry = new MappingCountryKazeco();

        if($modelCountry->load(\Yii::$app->request->post()) && $modelCountry->validate()){
            if ($modelCountry->load(Yii::$app->request->post()) && $modelCountry->save()) {
                return $this->redirect(['index']);
            }else {
                return $this->redirect(['index']);
            }
        }

        return  $this->render('index', compact(
            'callcenter',
            'country_count_by',
            'modelCountry',
            'dataProviderCountry',
            'searchModelCountry'
        ));
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



}
