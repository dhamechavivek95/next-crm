<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_customer}}".
 *
 * @property int $cu_id
 * @property string $first_name first name of customer
 * @property string $last_name last name of customer
 * @property string $address address of customer
 * @property string $email email id of customer
 * @property string $contact_number contact number of customer
 * @property string $website website link of customer
 * @property string $care_of_name customer's care of name
 * @property string $care_of_contact_number contact number of care of persion
 * @property string $care_of_address address of care of person
 * @property string $other other detail
 * @property string $bank_id customer's bank id
 * @property string $created_at
 * @property string $updated_at
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_customer}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'contact_number'], 'required'],
            [['other'], 'string'],
            [['first_name', 'last_name'], 'string', 'max' => 250],
            [['address', 'website', 'care_of_name', 'care_of_address'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 150],
            [['email'], 'email'],
            [['contact_number', 'care_of_contact_number'], 'string', 'max' => 15],
            [['bank_id', 'created_at', 'updated_at'], 'string', 'max' => 50],
            [['contact_number','care_of_contact_number'], 'integer'],
            ['website', 'url', 'defaultScheme' => 'http'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cu_id' => Yii::t('app', 'Cu ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'address' => Yii::t('app', 'Address'),
            'email' => Yii::t('app', 'Email'),
            'contact_number' => Yii::t('app', 'Contact Number'),
            'website' => Yii::t('app', 'Website'),
            'care_of_name' => Yii::t('app', 'Care Of Name'),
            'care_of_contact_number' => Yii::t('app', 'Care Of Contact Number'),
            'care_of_address' => Yii::t('app', 'Care Of Address'),
            'other' => Yii::t('app', 'Other'),
            'bank_id' => Yii::t('app', 'Bank ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
