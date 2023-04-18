<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230418_171629_createUser
 */
class m230418_171629_createUser extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'id_role' => $this->integer()->defaultValue(1),
            'login' => $this->string(13)->notNull(),
            'password' => $this->string(20)->notNull(),
            'first_name' => $this->string(20)->notNull(),
            'second_name' => $this->string(30)->notNull(),
            'surname' => $this->string(30)->notNull(),
        ]);

        $this->createIndex('idx_login', 'user', 'login');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');

    }

}
