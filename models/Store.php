<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store".
 *
 * @property int $code
 * @property string $name
 *
 * @property StoreProduct[] $storeProducts
 */
class Store extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Код склада',
            'name' => 'Наименование склада',
        ];
    }

    /**
     * Gets query for [[StoreProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProducts()
    {
        return $this->hasMany(StoreProduct::className(), ['store_code' => 'code']);
    }
}
