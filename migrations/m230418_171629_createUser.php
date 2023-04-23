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
            'auth_key' => $this->string()->notNull(),
        ]);

        $this->createIndex('idx_login', 'user', 'login');

        $this->insert('user', [
            'id_role' => 1,
            'login' => 'user',
            'password' => '123',
            'first_name' => 'Ivan',
            'second_name' => 'Ivanov',
            'surname' => 'Ivanovich',
            'auth_key' => \Yii::$app->security->generateRandomString(),
        ]);

        $this->insert('user', [
            'id_role' => 2,
            'login' => 'root',
            'password' => '123',
            'first_name' => 'Semen',
            'second_name' => 'Memniy',
            'surname' => 'Semenovich',
            'auth_key' => \Yii::$app->security->generateRandomString(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');

    }

}
