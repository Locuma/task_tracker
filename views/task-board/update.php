<?php

use app\models\forms\TaskBoardForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var TaskBoardForm $taskBoardForm */
/** @var app\models\TaskBoard $task */
/** @var app\models\User $users */

$this->title = 'Update Task Board: ' . $task->id;
$this->params['breadcrumbs'][] = ['label' => 'Task Boards', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $task->title, 'url' => ['view', 'id' => $task->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-board-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'task' => $task,
        'taskBoardForm' => $taskBoardForm,
        'users' => $users,

    ]) ?>

</div>
