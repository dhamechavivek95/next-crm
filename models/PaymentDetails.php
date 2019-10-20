<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%payment_detail}}".
 *
 * @property int $id unique id of payment detail
 * @property string $user_type
 * @property int $user_id
 * @property string $description
 * @property string $amount
 * @property string $payment_type 0-cash, 1-card, 2-cheque, 3-net banking
 * @property int $bill_id id of invoice or bill
 * @property int $bank_id user bank detail id
 * @property string $created_at
 * @property string $updated_at
 */
class PaymentDetails extends \yii\db\ActiveRecord
{

    public $cheque_no;
    public $cheque_due;
    public $cheque_type;
    public $transaction_id;
    public $net_username;
    public $net_mob_no;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%payment_detail}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_type', 'user_id', 'amount', 'payment_type', 'bank_id', 'created_at', 'updated_at'], 'required'],
            [['user_type', 'description', 'payment_type'], 'string'],
            [['user_id', 'bill_id', 'bank_id'], 'integer'],
            [['amount'], 'string', 'max' => 20],
            [['amount'], 'number', 'min' => 1],
            [['created_at', 'updated_at'], 'string', 'max' => 40],
            ['amount', 'match', 'pattern' => '/^[+-]?([0-9]*[.])?[0-9]+$/'],
            [
                ['cheque_no','cheque_due','cheque_type'],
                'required',
                'when' => function($model){
                    return $model->payment_type == 'CHEQUE';
                },
                'whenClient' => "function(attribute,value){
                        return $('#paymentdetails-payment_type').val() == 'CHEQUE'; 
                }"

            ],
            [
                ['transaction_id','net_username','net_mob_no'],
                'required',
                'when' => function($model){
                    return $model->payment_type == 'NET BANKING';
                },
                'whenClient' => "function(attribute,value){
                        return $('#paymentdetails-payment_type').val() == 'NET BANKING'; 
                }"

            ],
            [
            ['payment_done'],
            'safe'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_type' => Yii::t('app', 'User Type'),
            'user_id' => Yii::t('app', 'User'),
            'description' => Yii::t('app', 'Description'),
            'amount' => Yii::t('app', 'Amount'),
            'payment_type' => Yii::t('app', 'Payment Type'),
            'payment_done' => Yii::t('app', 'Payment Done'),
            'bill_id' => Yii::t('app', 'Bill ID'),
            'bank_id' => Yii::t('app', 'Bank'),
            'created_at' => Yii::t('app', 'Date'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'cheque_no' => Yii::t('app', 'Cheque No'),
            'cheque_due' => Yii::t('app', 'Cheque Due'),
            'cheque_type' => Yii::t('app', 'Cheque Type'),
            'transaction_id' => Yii::t('app', 'Transaction ID'),
            'net_username' => Yii::t('app', 'Username'),
            'net_mob_no' => Yii::t('app', 'Mobile No'),
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Contact::className(),['contact_id' => 'user_id']);
    }

    public function getBank()
    {
        return $this->hasOne(BankDetails::className(),['bank_id' => 'bank_id']);
    }
}
