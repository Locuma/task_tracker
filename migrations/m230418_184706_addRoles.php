<?php

use yii\db\Migration;

/**
 * Class m230418_184706_addRoles
 */
class m230418_184706_addRoles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
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
        $this->delete('role', ['name' => 'user']);
        $this->delete('role', ['name' => 'admin']);
    }

}
