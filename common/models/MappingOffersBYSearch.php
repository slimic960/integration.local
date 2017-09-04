<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MappingOffersBY;

/**
 * MappingOffersBYSearch represents the model behind the search form about `common\models\MappingOffersBY`.
 */
class MappingOffersBYSearch extends MappingOffersBY
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'productid', 'active'], 'integer'],
            [['sp_offer', 'by_offer'], 'safe'],
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
        $query = MappingOffersBY::find();

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
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'sp_offer', $this->sp_offer])
            ->andFilterWhere(['like', 'by_offer', $this->by_offer]);

        return $dataProvider;
    }
}
