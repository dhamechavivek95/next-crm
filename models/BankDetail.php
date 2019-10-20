<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank_detail".
 *
 * @property int $bank_id
 * @property string $bank_name
 * @property string $branch_name
 * @property string $account_no
 * @property string $account_type
 * @property string $ifsc_code
 */
class BankDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bank_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bank_name', 'account_no', 'account_type'], 'required'],
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
            'bank_id' => 'Bank ID',
            'bank_name' => 'Bank Name',
            'branch_name' => 'Branch Name',
            'account_no' => 'Account No',
            'account_type' => 'Account Type',
            'ifsc_code' => 'Ifsc Code',
        ];
    }
}
