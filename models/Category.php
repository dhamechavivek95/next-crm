<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property int $cat_id
 * @property string $cat_name
 * @property string $cat_desc
 */
class Category extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_name'], 'required'],
            [['cat_name'], 'unique'],
            [['cat_name'], 'string', 'max' => 100],
            [['cat_desc'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => Yii::t('app', 'ID'),
            'cat_name' => Yii::t('app', 'Name'),
            'cat_desc' => Yii::t('app', 'Description'),
        ];
    }
}
