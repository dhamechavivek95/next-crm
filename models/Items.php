<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use app\models\Category;
/**
 * This is the model class for table "{{%items}}".
 *
 * @property int $item_id
 * @property string $item_name
 * @property int $item_unit
 * @property string $item_type
 * @property string $item_desc
 * @property int $cat_id
 * @property string $tax_type
 * @property string $cgst_rate
 * @property string $sgst_rate
 * @property string $tax_type
 * @property int $hsn
 * @property double $sales_rate
 * @property string $sales_account
 * @property string $sales_desc
 * @property double $purchase_rate
 * @property string $purchase_account
 * @property string $purchase_desc
 * @property string $is_trackable
 * @property int $opening_stock
 * @property double $opening_stock_rate
 * @property double $stock_account
 */
class Items extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%items}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['item_type', 'default', 'value' => 'GOODS'],
            [['item_name', 'item_unit', 'item_type', 'cat_id'], 'required'],
            [['item_unit', 'cat_id', 'hsn', 'opening_stock'], 'integer'],
            [['sales_rate', 'purchase_rate', 'opening_stock_rate'], 'number'],
            [['sales_desc', 'purchase_desc', 'is_trackable'], 'string'],
            [['item_name', 'item_type', 'tax_type'], 'string', 'max' => 100],
            [['sales_account', 'purchase_account','stock_account','item_desc'], 'string', 'max' => 255],
            [['cgst_rate','sgst_rate'],'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_id' => Yii::t('app', 'ID'),
            'item_name' => Yii::t('app', 'Name'),
            'item_desc' => Yii::t('app', 'Description'),
            'item_unit' => Yii::t('app', 'Unit'),
            'item_type' => Yii::t('app', 'Type'),
            'cat_id' => Yii::t('app', 'Category'),
            'tax_type' => Yii::t('app', 'Tax Type'),
            'cgst_rate' => Yii::t('app', 'CGST Rate'),
            'sgst_rate' => Yii::t('app', 'SGST Rate'),
            'hsn' => Yii::t('app', 'HSN'),
            'sales_rate' => Yii::t('app', 'Rate'),
            'sales_account' => Yii::t('app', 'Account'),
            'sales_desc' => Yii::t('app', 'Description'),
            'purchase_rate' => Yii::t('app', 'Rate'),
            'purchase_account' => Yii::t('app', 'Account'),
            'purchase_desc' => Yii::t('app', 'Description'),
            'is_trackable' => Yii::t('app', 'Is Trackable'),
            'opening_stock' => Yii::t('app', 'Opening Stock'),
            'opening_stock_rate' => Yii::t('app', 'Opening Stock Rate'),
            'stock_account' => Yii::t('app', 'Account'),
        ];
    }

    public static function getAllItems()
    {
        return static::find()->all();
    }

    public static function getItemIdByName($name)
    {
        return (new Query())
        ->select('item_id')
        ->from(static::tableName())
        ->where(['item_name' => $name])
        ->scalar();
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(),['cat_id' => 'cat_id']);
    }
}
