<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%bill_master}}".
 *
 * @property int $bill_id
 * @property int $vendor_id
 * @property string $bill_number
 * @property string $due_date
 * @property string $total_amount
 * @property string $due_amount
 * @property string $created_date
 * @property string $updated_date
 */
class BillMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bill_master}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vendor_id', 'due_date', 'created_date', 'updated_date'], 'required'],
            [['vendor_id'], 'integer'],
            [['bill_number'], 'string', 'max' => 50],
            [['due_date', 'created_date', 'updated_date'], 'string', 'max' => 100],
            [['total_amount', 'due_amount'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bill_id' => Yii::t('app', 'Bill ID'),
            'vendor_id' => Yii::t('app', 'Vendor ID'),
            'bill_number' => Yii::t('app', 'Bill Number'),
            'due_date' => Yii::t('app', 'Due Date'),
            'total_amount' => Yii::t('app', 'Total Amount'),
            'due_amount' => Yii::t('app', 'Due Amount'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
        ];
    }

    public function getVendor()
    {
        return $this->hasOne(Contact::className(),['contact_id' => 'vendor_id']);
    }

    public function getBank()
    {
        return $this->hasOne(BankDetails::className(),['bank_id' => 'bank_id']);
    }
}
