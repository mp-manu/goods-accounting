<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store}}`.
 */
class m210303_053602_create_store_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store}}', [
            'code' => $this->primaryKey()->notNull(),
            'name' => $this->string('150')->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store}}');
    }
}
