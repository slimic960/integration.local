<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MappingOfferProductKazeco;

/**
 * MappingOfferProductKazecoSearch represents the model behind the search form about `common\models\MappingOfferProductKazeco`.
 */
class MappingOfferProductKazecoSearch extends MappingOfferProductKazeco
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'productid', 'gift', 'active'], 'integer'],
            [['product_name', 'product_kazeco', 'sp_offer'], 'safe'],
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
        $query = MappingOfferProductKazeco::find();

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
            'productid' => $this->productid,
            'gift' => $this->gift,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'product_kazeco', $this->product_kazeco])
            ->andFilterWhere(['like', 'sp_offer', $this->sp_offer]);

        return $dataProvider;
    }
}
