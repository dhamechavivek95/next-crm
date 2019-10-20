<?php

namespace app\models;

use Yii; 
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    public static function tableName()
    {
        return 'admin';
  }

       /**
     * @inheritdoc
     */
       public function rules()
       {
        return [
            [['username','password'], 'required'],
            [['email'], 'email'],
            [['username','email'], 'unique'],
            [['contact_number'],'string','max' => 30],
            [['username','password','first_name','last_name'], 'string', 'max' => 250],
        ];
    }

    public static function findIdentity($id) {
        $user = self::find()->where(["id" => $id])->one();
        if (!$user instanceof User) {
            return null;
        }
        return new static($user);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $userType = null) {

        $user = self::find()
        ->where(["accessToken" => $token])
        ->one();
        if (!$user instanceof User) {
            return null;
        }
        return new static($user);
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username) {
        $user = self::find()
        ->where([
            "username" => $username
            ])->orWhere(["email" => $username])
        ->one();
        if (!$user instanceof User) {
            return null;
        }
        return new static($user);
    }

    /**
     * Finds user by email
     *
     * @param  string      $email
     * @return static|null
     */
    public static function findByEmail($email) {
        $user = self::find()
        ->where([
            "email" => $email
            ])
        ->one();
        if (!$user instanceof User) {
            return null;
        }
        return new static($user);
    }

    public static function findByUser($username) {
        $user = self::find()
        ->where([
            "username" => $username
            ])
        ->one();
        if (!$user instanceof User) {
            return null;
        }
        return $user;
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return '';
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return $this->password ===  md5($password);
    }
}
