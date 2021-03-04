<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m210303_035724_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'user_id' => $this->primaryKey(),
            'username' => $this->string('65')->unique()->notNull(),
            'user_password' => $this->string('150')->notNull(),
            'fio' => $this->string('255'),
            'telefon' => $this->string('255'),
            'email' => $this->string('255')->unique()->notNull(),
            'user_type' => "ENUM('admin', 'user')",
            'is_block' => $this->tinyInteger(2)->defaultValue(0),
            'photo' => $this->string('255'),
            'auth_key' => $this->string('255'),
            'secret_key' => $this->string('255'),
            'created_at' => $this->dateTime(),
            'created_by' => $this->integer(11),
            'updated_at' => $this->dateTime(),
            'updated_by' => $this->integer(11),
        ]);

        $this->insert('user', [
            'username' => 'admin',
            'user_password' => md5('admin123admin123'),
            'fio' => 'Администратор',
            'telefon' => '',
            'email' => 'admin@gmail.com',
            'user_type' => "admin",
            'is_block' => 0,
            'photo' => '',
            'auth_key' => '',
            'secret_key' => '',
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => '',
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => '',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
