<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store_product".
 *
 * @property int $id
 * @property int $store_code
 * @property int $product_id
 * @property float|null $price
 * @property float|null $quantity
 *
 * @property Store $storeCode
 * @property Product $product
 */
class StoreProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['store_code', 'product_id'], 'required'],
            [['store_code', 'product_id'], 'integer'],
            [['price', 'quantity'], 'number'],
            [['store_code'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['store_code' => 'code']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'store_code' => 'Код склада',
            'product_id' => 'Продукт',
            'quantity' => 'Количество',
            'price' => 'Стоимость',
        ];
    }

    /**
     * Gets query for [[StoreCode]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoreCode()
    {
        return $this->hasOne(Store::className(), ['code' => 'store_code']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
