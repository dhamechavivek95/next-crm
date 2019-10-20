<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user_cheque_detail}}".
 *
 * @property int $chq_id
 * @property int $payment_id
 * @property string $cheque_no
 * @property string $cheque_due
 * @property string $cheque_type
 */
class UserChequeDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_cheque_detail}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payment_id', 'cheque_no', 'cheque_due', 'cheque_type'], 'required'],
            [['payment_id'], 'integer'],
            [['cheque_no'], 'string', 'max' => 150],
            [['cheque_due'], 'string', 'max' => 100],
            [['cheque_type'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'chq_id' => Yii::t('app', 'Chq ID'),
            'payment_id' => Yii::t('app', 'Payment ID'),
            'cheque_no' => Yii::t('app', 'Cheque No'),
            'cheque_due' => Yii::t('app', 'Cheque Due'),
            'cheque_type' => Yii::t('app', 'Cheque Type'),
        ];
    }
}
