<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%contact}}".
 *
 * @property int $contact_id Contact Primary Key
 * @property string $first_name First Name
 * @property string $last_name Last Name
 * @property string $company_name Company Name
 * @property string $display_name Display Name
 * @property string $contact_email Contact Email
 * @property string $contact_person Contact Person 
 * @property string $mobile_no Contact Number
 * @property string $contact_type Contact Type
 * @property string $website Website
 * @property string $contact_address Website
 */
class Contact extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%contact}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'company_name', 'display_name', 'contact_type'], 'required'],
            [['contact_type'], 'string'],
            [['first_name', 'last_name', 'company_name', 'display_name'], 'string', 'max' => 255],
            [['first_name', 'last_name'], 'string', 'max' => 50],
            [['contact_email', 'contact_person', 'website'], 'string', 'max' => 100],
            [['mobile_no','contact_mobile_no'], 'string', 'max' => 15],
            [['contact_address','address'], 'string', 'max' => 512],
            [['mobile_no'], 'number'],
            [['contact_email','email'], 'email'],
            [['contact_address'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'contact_id' => Yii::t('app', 'Contact ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'company_name' => Yii::t('app', 'Company Name'),
            'display_name' => Yii::t('app', 'Name'),
            'contact_email' => Yii::t('app', 'Email'),
            'contact_person' => Yii::t('app', 'Name'),
            'mobile_no' => Yii::t('app', 'Mobile No'),
            'contact_mobile_no' => Yii::t('app', 'Mobile No'),
            'contact_type' => Yii::t('app', 'Contact Type'),
            'website' => Yii::t('app', 'Website'),
            'contact_address' => Yii::t('app', 'Address'),
        ];
    }

    public function getDue_amount()
    {
        if($this->contact_type == 'VENDOR'){
            $billAmount = BillMaster::find()->where(['vendor_id' => $this->contact_id])->sum('due_amount');
            return $billAmount;
        }elseif ($this->contact_type == 'CUSTOMER') {
            $invoiceAmount = Invoice::find()->where(['customer_id' => $this->contact_id])->sum('due_amount');
            return $invoiceAmount;
        }
    }

    public function getTotal_amount()
    {
       if($this->contact_type == 'VENDOR'){
            $billAmount = BillMaster::find()->where(['vendor_id' => $this->contact_id])->sum('total_amount');
            return $billAmount;
        }elseif ($this->contact_type == 'CUSTOMER') {
            $invoiceAmount = Invoice::find()->where(['customer_id' => $this->contact_id])->sum('total_amount');
            return $invoiceAmount;
        }
    }
}
