<?php

namespace app\models;

use yii\base\Model;

class TaskBoardForm extends Model
{
    public ?string $title = null;
    public ?int $supervisor = null;
    public ?int $responsible = null;
    public ?string $deadline = null;

    public function rules(): array
    {
        return [
            [['title', 'supervisor', 'responsible', 'deadline'], 'required'],
            [['title'], 'string', 'max' => 300],
        ];
    }

    public function findAll(): array
    {
        $tasksBoard = TaskBoard::find()->all();
        $tasks = [];
        if (!empty($tasksBoard)) {
            foreach ($tasksBoard as $task){
                $tasks[] = [
                    $this->title => $task->title,
                    $this->supervisor => $task->supervisor,
                    $this->responsible => $task->responsible,
                    $this->deadline => $task->deadline,
                ];
            }
        }
        return $tasks;
    }

}