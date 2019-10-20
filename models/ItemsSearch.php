<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Items;

/**
 * ItemsSearch represents the model behind the search form of `app\models\Items`.
 */
class ItemsSearch extends Items
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'item_unit', 'cat_id', 'hsn', 'opening_stock'], 'integer'],
            [['item_name', 'item_type', 'tax_type', 'sales_account', 'sales_desc', 'purchase_account', 'purchase_desc', 'is_trackable','stock_account','cgst_rate','sgst_rate','cat_id'], 'safe'],
            [['sales_rate', 'purchase_rate', 'opening_stock_rate'], 'number'],
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
        $query = Items::find();

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

        $query->joinWith('category');

        // grid filtering conditions
        $query->andFilterWhere([
            'item_id' => $this->item_id,
            'item_unit' => $this->item_unit,
            'hsn' => $this->hsn,
            'sales_rate' => $this->sales_rate,
            'purchase_rate' => $this->purchase_rate,
            'opening_stock' => $this->opening_stock,
            'opening_stock_rate' => $this->opening_stock_rate,
            'stock_account' => $this->stock_account,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'item_type', $this->item_type])
            ->andFilterWhere(['like', 'tax_type', $this->tax_type])
            ->andFilterWhere(['like', 'sales_account', $this->sales_account])
            ->andFilterWhere(['like', 'sales_desc', $this->sales_desc])
            ->andFilterWhere(['like', 'purchase_account', $this->purchase_account])
            ->andFilterWhere(['like', 'purchase_desc', $this->purchase_desc])
            ->andFilterWhere(['like', 'is_trackable', $this->is_trackable])
            ->andFilterWhere(['like', 'category.cat_name', $this->cat_id]);

        return $dataProvider;
    }
}
