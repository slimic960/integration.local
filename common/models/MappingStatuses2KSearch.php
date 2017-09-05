<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MappingStatuses2K;

/**
 * MappingStatuses2KSearch represents the model behind the search form about `common\models\MappingStatuses2K`.
 */
class MappingStatuses2KSearch extends MappingStatuses2K
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status_terminal'], 'integer'],
            [['sostatus', 'main_status'], 'safe'],
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
        $query = MappingStatuses2K::find();

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
            'status_terminal' => $this->status_terminal,
        ]);

        $query->andFilterWhere(['like', 'sostatus', $this->sostatus])
            ->andFilterWhere(['like', 'main_status', $this->main_status]);

        return $dataProvider;
    }
}
