<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class TaskBoard extends ActiveRecord
{
    /**
     * @property int $id
     * @property string $title
     * @property string supervisor
     * @property string responsible
     * @property string $deadline
     */

    public static function tableName(): string
    {
        return '{{%task_board}}';
    }

    public function getResponsible(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'responsible']);
    }

    public function getSupervisor(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'supervisor']);
    }

    public function fillTaskBoard(TaskBoardForm $model): void
    {
        $this->title = $model->title;
        $this->responsible = $model->responsible;
        $this->supervisor = $model->supervisor;
        $this->deadline = $model->deadline;
    }

}