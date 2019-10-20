<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user_ntb_details}}".
 *
 * @property int $ntb_id
 * @property int $payment_id
 * @property string $transection_id
 * @property string $ntb_username
 * @property string $ntb_mo_no
 */
class NetBankingDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_ntb_details}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payment_id', 'transection_id', 'ntb_username', 'ntb_mo_no'], 'required'],
            [['payment_id'], 'integer'],
            [['transection_id', 'ntb_username'], 'string', 'max' => 100],
            [['ntb_mo_no'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ntb_id' => Yii::t('app', 'ID'),
            'payment_id' => Yii::t('app', 'Payment ID'),
            'transection_id' => Yii::t('app', 'Transection ID'),
            'ntb_username' => Yii::t('app', 'Username'),
            'ntb_mo_no' => Yii::t('app', 'Mobile No'),
        ];
    }
}
