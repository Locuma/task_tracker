<?php

namespace app\models\forms;

use app\models\TaskBoard;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\validators\DateValidator;

class TaskBoardForm extends Model
{
    public ?string $title = null;
    public ?int $id_supervisor = null;
    public ?int $id_responsible = null;
    public ?string $deadline = null;

    public function rules(): array
    {
        return [
            [['title', 'id_supervisor', 'id_responsible', 'deadline'], 'required'],
            ['deadline', DateValidator::class, 'format' => 'yyyy-MM-dd'],
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
                    $this->id_supervisor => $task->id_supervisor,
                    $this->id_responsible => $task->id_responsible,
                    $this->deadline => $task->deadline,
                ];
            }
        }
        return $tasks;
    }

    public function search($params)
    {
        $query = TaskBoard::find();


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_supervisor' => $this->id_supervisor,
            'id_responsible' => $this->id_responsible,
            'deadline' => $this->deadline,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }

}