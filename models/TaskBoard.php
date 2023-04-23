<?php

namespace app\models;

use app\models\forms\TaskBoardForm;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class TaskBoard extends ActiveRecord
{
    /**
     * @property int $id
     * @property string $title
     * @property string id_supervisor
     * @property string id_responsible
     * @property string $deadline
     */

    public static function tableName(): string
    {
        return '{{%task_board}}';
    }

    public function getResponsible(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'id_responsible']);
    }

    public function getSupervisor(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'id_supervisor']);
    }

    public function afterFind(): void
    {
        parent::afterFind();
        $this->deadline = Yii::$app->formatter->asDatetime($this->deadline, 'yyyy-MM-dd');
    }

    public function fillTaskBoard(TaskBoardForm $model): void
    {
        $this->title = $model->title;
        $this->id_responsible = $model->id_responsible;
        $this->id_supervisor = $model->id_supervisor;
        $this->deadline = Yii::$app->formatter->asDatetime($model->deadline, 'yyyy-MM-dd');
    }

}