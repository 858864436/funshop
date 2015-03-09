<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Bonus;

/**
 * BonusSearch represents the model behind the search form about `common\models\Bonus`.
 */
class BonusSearch extends Bonus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'bonus_type_id', 'started_at', 'ended_at', 'order_id', 'used_at', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['money', 'min_amount'], 'number'],
            [['sn'], 'safe'],
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
        $query = Bonus::find();
        
        $query->orderBy(['created_at' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'bonus_type_id' => $this->bonus_type_id,
            'money' => $this->money,
            'min_amount' => $this->min_amount,
            'started_at' => $this->started_at,
            'ended_at' => $this->ended_at,
            'order_id' => $this->order_id,
            'used_at' => $this->used_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'sn', $this->sn]);

        return $dataProvider;
    }
}