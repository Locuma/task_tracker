<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TaskBoardForm $task */
/** @var app\models\User $users */

$this->title = 'Create Task Board';
$this->params['breadcrumbs'][] = ['label' => 'Task Boards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-board-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'task' => $task,
        'users' => $users,
    ]) ?>

</div>
