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
            'id_supervisor' => $this->integer()->notNull(),
            'id_responsible' => $this->integer()->notNull(),
            'deadline' => $this->dateTime()->notNull(),
        ]);

        $this->createIndex('idx_id_supervisor', 'task_board', 'id_supervisor');
        $this->createIndex('idx_id_responsible', 'task_board', 'id_responsible');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('task_board');
    }

}
