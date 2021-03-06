<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Auto;

/**
 * AutoSearch represents the model behind the search form about `common\models\Auto`.
 */
class AutoSearch extends Auto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'idcat', 'priceT', 'priceC'], 'integer'],
            [['name', 'photo', 'carnumber', 'maxpas', 'active'], 'safe'],
            [['cent'], 'number'],
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
        $query = Auto::find()->orderBy('idcat');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'idcat' => $this->idcat,
            'priceT' => $this->priceT,
            'priceC' => $this->priceC,
            'cent' => $this->cent,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'carnumber', $this->carnumber])
            ->andFilterWhere(['like', 'maxpas', $this->maxpas])
            ->andFilterWhere(['like', 'active', $this->active]);

        return $dataProvider;
    }
}
