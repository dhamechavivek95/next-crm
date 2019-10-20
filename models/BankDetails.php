<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%bank_detail}}".
 *
 * @property int $bank_id
 * @property string $bank_name
 * @property string $branch_name
 * @property string $account_no
 * @property string $account_type
 * @property string $ifsc_code
 */
class BankDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bank_detail}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_no', 'account_type'], 'required'],
            [['bank_name', 'branch_name', 'account_no'], 'string', 'max' => 255],
            [['account_type', 'ifsc_code'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bank_id' => Yii::t('app', 'Bank ID'),
            'bank_name' => Yii::t('app', 'Bank Name'),
            'branch_name' => Yii::t('app', 'Branch Name'),
            'account_no' => Yii::t('app', 'Account No'),
            'account_type' => Yii::t('app', 'Account Type'),
            'ifsc_code' => Yii::t('app', 'Ifsc Code'),
        ];
    }
}
