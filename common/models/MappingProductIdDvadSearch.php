<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MappingProductIdDvad;

/**
 * MappingProductIdDvadSearch represents the model behind the search form about `\common\models\MappingProductIdDvad`.
 */
class MappingProductIdDvadSearch extends MappingProductIdDvad
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status_active'], 'integer'],
            [['order_items_productId', 'productid', 'product_name'], 'safe'],
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
        $query = MappingProductIdDvad::find();

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

        $query->andFilterWhere(['like', 'order_items_productId', $this->order_items_productId])
            ->andFilterWhere(['like', 'productid', $this->productid])
            ->andFilterWhere(['like', 'product_name', $this->product_name]);

        return $dataProvider;
    }
}
