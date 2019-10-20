<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%invoice_items}}".
 *
 * @property int $id
 * @property int $inv_id
 * @property int $item_id
 * @property string $date
 * @property string $description
 * @property string $length
 * @property string $width
 * @property string $quantity
 * @property string $quantity_feet
 * @property string $unit
 * @property string $rate
 * @property string $total_price
 */
class InvoiceItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%invoice_items}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inv_id','date', 'item_id', 'length', 'width', 'quantity', 'quantity_feet', 'rate'], 'required','message' => 'Required'],
            [['inv_id', 'item_id'], 'integer'],
            [['date'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255],
            [['length', 'width', 'total_price'], 'string', 'max' => 20],
            [['quantity'], 'string', 'max' => 60],
            [['quantity_feet', 'unit', 'rate'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'inv_id' => Yii::t('app', 'Inv ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'date' => Yii::t('app', 'Date'),
            'description' => Yii::t('app', 'Description'),
            'length' => Yii::t('app', 'Length'),
            'width' => Yii::t('app', 'Width'),
            'quantity' => Yii::t('app', 'Quantity'),
            'quantity_feet' => Yii::t('app', 'Quantity Feet'),
            'unit' => Yii::t('app', 'Unit'),
            'rate' => Yii::t('app', 'Rate'),
            'total_price' => Yii::t('app', 'Total Price'),
        ];
    }
}
