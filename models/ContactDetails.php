<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%contact_details}}".
 *
 * @property int $id Primary Key
 * @property int $contact_id Contact Foreign Key
 * @property string $payment_terms Payment Terms in terms of days
 * @property string $gst_treatment Dropdown list whether it is gst applicable
 * @property string $gst_number If Applicable then Number
 * @property string $place_of_supply Place of Supply (state)
 * @property double $opening_balance Opening Balance
 * @property string $pan_number PAN Number(Not Necessary)
 * @property double $discount Discount
 * @property double $credit_limit Credit Limit(Not Necessary)
 */
class ContactDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%contact_details}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contact_id', 'payment_terms'], 'required'],
            [['contact_id'], 'integer'],
            [['opening_balance', 'discount', 'credit_limit'], 'number'],
            [['payment_terms', 'gst_treatment', 'place_of_supply'], 'string', 'max' => 100],
            [['gst_number'], 'string', 'max' => 45],
            [['pan_number'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'contact_id' => Yii::t('app', 'Contact ID'),
            'payment_terms' => Yii::t('app', 'Payment Terms'),
            'gst_treatment' => Yii::t('app', 'Gst Treatment'),
            'gst_number' => Yii::t('app', 'Gst Number'),
            'place_of_supply' => Yii::t('app', 'Place Of Supply'),
            'opening_balance' => Yii::t('app', 'Opening Balance'),
            'pan_number' => Yii::t('app', 'Pan Number'),
            'discount' => Yii::t('app', 'Discount'),
            'credit_limit' => Yii::t('app', 'Credit Limit'),
        ];
    }
}
