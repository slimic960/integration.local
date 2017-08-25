<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MappingOfferProductRgrk;

/**
 * MappingOfferProductRgrkSearch represents the model behind the search form about `common\models\MappingOfferProductRgrk`.
 */
class MappingOfferProductRgrkSearch extends MappingOfferProductRgrk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status_active'], 'integer'],
            [['sp_offer', 'good_id', 'productid', 'gift', 'product_name'], 'safe'],
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
        $query = MappingOfferProductRgrk::find();

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

        $query->andFilterWhere(['like', 'sp_offer', $this->sp_offer])
            ->andFilterWhere(['like', 'good_id', $this->good_id])
            ->andFilterWhere(['like', 'productid', $this->productid])
            ->andFilterWhere(['like', 'gift', $this->gift])
            ->andFilterWhere(['like', 'product_name', $this->product_name]);

        return $dataProvider;
    }
}
