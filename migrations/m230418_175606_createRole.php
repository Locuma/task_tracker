<?php

use yii\db\Migration;

/**
 * Class m230418_175606_createRole
 */
class m230418_175606_createRole extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('role', [
            'id' => $this->primaryKey(),
            'name' => $this->string(20)->notNull(),
        ]);

        $this->insert('role', [
            'name' => 'user'
        ]);

        $this->insert('role', [
            'name' => 'admin'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('role');
    }

}
