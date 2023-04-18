<?php

use yii\db\Migration;

/**
 * Class m230418_181909_createTaskBoard
 */
class m230418_181909_createTaskBoard extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('task_board', [
            'id' => $this->primaryKey(),
            'title' => $this->string(300)->notNull(),
            'supervisor' => $this->integer()->notNull(),
            'responsible' => $this->integer()->notNull(),
            'deadline' => $this->dateTime()->notNull(),
        ]);

        $this->createIndex('idx_supervisor', 'task_board', 'supervisor');
        $this->createIndex('idx_responsible', 'task_board', 'responsible');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230418_181909_createTaskBoard cannot be reverted.\n";

        return false;
    }

}
