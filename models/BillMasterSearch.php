<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BillMaster;

/**
 * BillMasterSearch represents the model behind the search form of `app\models\BillMaster`.
 */
class BillMasterSearch extends BillMaster
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bill_id', 'vendor_id'], 'integer'],
            [['bill_number', 'due_date', 'total_amount', 'due_amount', 'created_date', 'updated_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = BillMaster::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        /*if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }*/

        $query->joinWith('vendor');

        // grid filtering conditions
        $query->andFilterWhere([
            'bill_id' => $this->bill_id,
        ]);

        $query->andFilterWhere(['like', 'bill_number', $this->bill_number])
            ->andFilterWhere(['like', 'due_date', $this->due_date])
            ->andFilterWhere(['like', 'total_amount', $this->total_amount])
            ->andFilterWhere(['like', 'due_amount', $this->due_amount])
            ->andFilterWhere(['like', 'created_date', $this->created_date])
            ->andFilterWhere(['like', 'updated_date', $this->updated_date]);

        return $dataProvider;
    }
}
