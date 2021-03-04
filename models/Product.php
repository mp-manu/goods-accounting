<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 *
 * @property StoreProduct[] $storeProducts
 */
class Product extends \yii\db\ActiveRecord
{
    public $storename;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 150],
            [['description'], 'string', 'max' => 1500],
            ['manufacturing_date', 'date', 'format' => 'Y-m-d'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование товара',
            'description' => 'Описание товара ',
            'manufacturing_date' => 'Дата изготовления ',
        ];
    }

    /**
     * Gets query for [[StoreProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProducts()
    {
        return $this->hasMany(StoreProduct::className(), ['product_id' => 'id']);
    }

    public function getDetails(){
        $details = StoreProduct::find()->joinWith('storeCode')->where(['product_id' => $this->id])->all();
        return $details;
    }

    public static function strLimit($text){
        if(mb_strlen($text) > 50){
            return mb_substr($text, 0, 50).'...';
        }
        return $text;
    }
}
