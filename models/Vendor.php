<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_vendor}}".
 *
 * @property int $vn_id vendor unique id
 * @property string $first_name first name of vendor
 * @property string $last_name last name of vendor
 * @property string $address vendor address
 * @property string $email email id of vendor
 * @property string $contact_number contact number of vendor
 * @property string $website vendor website
 * @property string $other other details
 * @property double $receivable receivable payment
 * @property double $payable payable payment
 * @property string $payment_status status of payment
 * @property string $payment_mode method of payment
 * @property int $bank_id tbl_bankdetail id
 * @property string $created_at created at
 * @property string $updated_at updated at
 */
class Vendor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_vendor}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vn_id', 'bank_id'], 'integer'],
            [['first_name', 'email', 'contact_number'], 'required'],
            [['first_name', 'last_name', 'website'], 'string', 'max' => 255],
            [['address', 'other'], 'string', 'max' => 511],
            [['email'], 'string', 'max' => 150],
            [['email'], 'email'],
            [['contact_number'], 'string', 'max' => 15],
            [['contact_number'], 'integer'],
            [['created_at', 'updated_at'], 'string', 'max' => 50],
            ['website', 'url', 'defaultScheme' => 'http'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'vn_id' => 'Vn ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'address' => 'Address',
            'email' => 'Email',
            'contact_number' => 'Contact Number',
            'website' => 'Website',
            'other' => 'Other',
            'receivable' => 'Receivable',
            'payable' => 'Payable',
            'payment_status' => 'Payment Status',
            'payment_mode' => 'Payment Mode',
            'bank_id' => 'Bank ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getDue_amount()
    {
        pd('as');
    }
}
