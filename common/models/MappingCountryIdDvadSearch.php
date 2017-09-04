<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MappingCountryIdDvad;

/**
 * MappingCountryIdDvadSearch represents the model behind the search form about `\common\models\MappingCountryIdDvad`.
 */
class MappingCountryIdDvadSearch extends MappingCountryIdDvad
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status_active'], 'integer'],
            [['order_delivery_address_countryIso', 'sp_so_country'], 'safe'],
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
        $query = MappingCountryIdDvad::find();

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

        $query->andFilterWhere(['like', 'order_delivery_address_countryIso', $this->order_delivery_address_countryIso])
            ->andFilterWhere(['like', 'sp_so_country', $this->sp_so_country]);

        return $dataProvider;
    }
}
