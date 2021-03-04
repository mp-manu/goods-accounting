<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_product}}`.
 */
class m210303_054228_create_store_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_product}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11)->notNull(),
            'store_code' => $this->integer(11)->notNull(),
            'quantity' => $this->decimal('11', '2'),
            'price' => $this->decimal('11', '2'),
        ]);

        $this->createIndex(
            'idx-store_product-product_id',
            'store_product',
            'product_id'
        );

        $this->addForeignKey(
            'fk-store_product-product_id',
            'store_product',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-store-store_id',
            'store_product',
            'store_code',
            'store',
            'code',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_product}}');
    }
}
