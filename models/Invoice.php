<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%invoice_master}}".
 *
 * @property int $inv_id
 * @property int $customer_id
 * @property string $invoice_number
 * @property string $due_date
 * @property string $total_amount
 * @property string $created_date
 * @property string $updated_date
 */
class Invoice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%invoice_master}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'due_date','total_amount','created_date', 'updated_date'], 'required'],
            [['customer_id'], 'integer'],
            [['invoice_number'], 'string', 'max' => 50],
            [['due_date', 'created_date', 'updated_date'], 'string', 'max' => 100],
            [['total_amount'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'inv_id' => Yii::t('app', 'Inv ID'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'invoice_number' => Yii::t('app', 'Invoice Number'),
            'due_date' => Yii::t('app', 'Due Date'),
            'total_amount' => Yii::t('app', 'Total Amount'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
        ];
    }

    public function getCustomer()
    {
        return $this->hasOne(Contact::className(),['contact_id' => 'customer_id']);
    }

    public function getBank()
    {
        return $this->hasOne(BankDetails::className(),['bank_id' => 'bank_id']);
    }
}
