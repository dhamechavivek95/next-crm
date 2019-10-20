<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%bill_extra}}".
 *
 * @property int $id
 * @property int $bill_id
 * @property string $extra_mold_image
 * @property string $extra_date
 * @property string $extra_description
 * @property string $extra_total_size
 * @property string $extra_quantity
 * @property string $extra_rate
 * @property string $extra_total_rate
 */
class BillExtra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bill_extra}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bill_id'], 'required'],
            [['bill_id'], 'integer'],
            [['extra_mold_image'], 'string', 'max' => 10],
            [['extra_date'], 'string', 'max' => 50],
            [['extra_description'], 'string', 'max' => 255],
            [['extra_total_size', 'extra_quantity', 'extra_rate', 'extra_total_rate'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'bill_id' => Yii::t('app', 'Bill ID'),
            'extra_mold_image' => Yii::t('app', 'Extra Mold Image'),
            'extra_date' => Yii::t('app', 'Extra Date'),
            'extra_description' => Yii::t('app', 'Extra Description'),
            'extra_total_size' => Yii::t('app', 'Extra Total Size'),
            'extra_quantity' => Yii::t('app', 'Extra Quantity'),
            'extra_rate' => Yii::t('app', 'Extra Rate'),
            'extra_total_rate' => Yii::t('app', 'Extra Total Rate'),
        ];
    }
}
