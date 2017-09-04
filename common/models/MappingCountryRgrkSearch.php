<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MappingCountryRgrk;

/**
 * MappingCountryRgrkSearch represents the model behind the search form about `common\models\MappingCountryRgrk`.
 */
class MappingCountryRgrkSearch extends MappingCountryRgrk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status_active'], 'integer'],
            [['sp_country', 'sp_so_country', 'sp_delivery_service', 'currency_id'], 'safe'],
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
        $query = MappingCountryRgrk::find();

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

        $query->andFilterWhere(['like', 'sp_country', $this->sp_country])
            ->andFilterWhere(['like', 'sp_so_country', $this->sp_so_country])
            ->andFilterWhere(['like', 'sp_delivery_service', $this->sp_delivery_service])
            ->andFilterWhere(['like', 'currency_id', $this->currency_id]);

        return $dataProvider;
    }
}
