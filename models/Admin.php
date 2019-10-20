<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%admin}}".
 *
 * @property int $id Admin Primary Key
 * @property string $first_name Admin First Name
 * @property string $last_name Admin Last Name
 * @property string $email Admin Email
 * @property string $contact_number Contact Number
 * @property string $username Admin Username
 * @property string $last_login Last Login
 */
class Admin extends ActiveRecord
{

    public $oldPassword;

    public $newPassword;

    public $confirmPassword;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%admin}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'contact_number', 'username','password'], 'required'],
            [['email', 'last_login','password'], 'string', 'max' => 255],
            [['first_name','last_name','username'], 'string', 'max' => 15],
            [['contact_number'], 'string', 'max' => 15],
            [['contact_number'], 'integer'],
            [['oldPassword','newPassword','confirmPassword'], 'required','on' => 'changePassword'],
            [['oldPassword'], 'validatePassword','on' => 'changePassword','message' => 'Please enter correct Old Password'],
            ['newPassword', 'compare', 'compareAttribute' => 'confirmPassword','operator' => '==','on' => 'changePassword','message' => 'New Password must be same as "Confirm Password".'],
            [[
                'oldPassword',
                'newPassword',
                'confirmPassword',
                'first_name',
                'last_name',
                'email',
                'contact_number',
                'username',
                'password',

            ],'safe'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'contact_number' => 'Contact Number',
            'username' => 'Username',
            'password' => 'Password',
            'last_login' => 'Last Login',
        ];
    }

    public static function updateLastLogin()
    {
        $admin = static::findOne(['id' => Yii::$app->user->id]);
        if($admin instanceof Admin){
            $admin->last_login = date('Y-m-d H:i:s');
            $admin->save(false);
        }
    }

    public function validatePassword($attribute)
    {
        $user = static::findOne(Yii::$app->user->id);
        if ($user->password != md5($this->oldPassword))
            $this->addError($attribute, 'Old password is incorrect.');
    }

}
