<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%address}}".
 *
 * @property int $id
 * @property int $contact_id Contact Foreign Key
 * @property string $billing_attention
 * @property string $billing_street
 * @property string $billing_city
 * @property string $billing_state
 * @property int $billing_pincode
 * @property string $billing_country
 * @property string $shipping_attention
 * @property string $shipping_street
 * @property string $shipping_city
 * @property string $shipping_state
 * @property int $shipping_pincode
 * @property string $shipping_country
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%address}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contact_id'], 'required'],
            [['contact_id', 'billing_pincode', 'shipping_pincode'], 'integer'],
            [['billing_attention', 'billing_street', 'billing_city', 'billing_state', 'shipping_attention', 'shipping_street', 'shipping_city', 'shipping_state'], 'string', 'max' => 255],
            [['billing_country', 'shipping_country'], 'string', 'max' => 100],
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
            'billing_attention' => Yii::t('app', 'Billing Attention'),
            'billing_street' => Yii::t('app', 'Billing Street'),
            'billing_city' => Yii::t('app', 'Billing City'),
            'billing_state' => Yii::t('app', 'Billing State'),
            'billing_pincode' => Yii::t('app', 'Billing Pincode'),
            'billing_country' => Yii::t('app', 'Billing Country'),
            'shipping_attention' => Yii::t('app', 'Shipping Attention'),
            'shipping_street' => Yii::t('app', 'Shipping Street'),
            'shipping_city' => Yii::t('app', 'Shipping City'),
            'shipping_state' => Yii::t('app', 'Shipping State'),
            'shipping_pincode' => Yii::t('app', 'Shipping Pincode'),
            'shipping_country' => Yii::t('app', 'Shipping Country'),
        ];
    }
}
