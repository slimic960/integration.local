<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MappingDeliveryServiceKazeco;

/**
 * MappingDeliveryServiceKazecoSearch represents the model behind the search form about `common\models\MappingDeliveryServiceKazeco`.
 */
class MappingDeliveryServiceKazecoSearch extends MappingDeliveryServiceKazeco
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status_active'], 'integer'],
            [['sp_delivery_service', 'kz_delivery', 'kz_delivery_name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MappingDeliveryServiceKazeco::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status_active' => $this->status_active,
        ]);

        $query->andFilterWhere(['like', 'sp_delivery_service', $this->sp_delivery_service])
            ->andFilterWhere(['like', 'kz_delivery', $this->kz_delivery])
            ->andFilterWhere(['like', 'kz_delivery_name', $this->kz_delivery_name]);

        return $dataProvider;
    }
}
