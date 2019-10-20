<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%invoice_extra}}".
 *
 * @property int $id
 * @property int $inv_id
 * @property string $extra_mold_image
 * @property string $extra_date
 * @property string $extra_description
 * @property string $extra_total_size
 * @property string $extra_quantity
 * @property string $extra_rate
 * @property string $extra_total_rate
 */
class InvoiceExtra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%invoice_extra}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inv_id','extra_date','extra_total_rate'], 'required','message' => 'Required'],
            [['inv_id'], 'integer'],
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
            'inv_id' => Yii::t('app', 'Inv ID'),
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
