<?php

use app\models\forms\TaskBoardForm;
use app\models\TaskBoard;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var TaskBoardForm $taskBoardForm */
/** @var TaskBoard $task */
/** @var app\models\User $users */

$this->title = 'Create Task Board';
$this->params['breadcrumbs'][] = ['label' => 'Task Boards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-board-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'taskBoardForm' => $taskBoardForm,
        'task' => $task,
        'users' => $users,
    ]) ?>

</div>
