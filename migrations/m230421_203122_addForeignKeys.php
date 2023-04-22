<?php

use yii\db\Migration;

/**
 * Class m230421_203122_addForeignKeys
 */
class m230421_203122_addForeignKeys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-task_board-supervisor',
            'task_board',
            'supervisor',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-task_board-responsible',
            'task_board',
            'responsible',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-user-role',
            'user',
            'id_role',
            'role',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-task_board-supervisor', 'task_board');
        $this->dropForeignKey('fk-task_board-responsible', 'task_board');
    }

}
