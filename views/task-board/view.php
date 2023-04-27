<?php

use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\TaskBoard $task */
/** @var app\models\User $user */

$this->title = $task->title;
$this->params['breadcrumbs'][] = ['label' => 'Task Boards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$supervisorName = "{$task->supervisor->first_name} {$task->supervisor->second_name} {$task->supervisor->surname} ";
$responsibleName = "{$task->responsible->first_name} {$task->responsible->second_name} {$task->responsible->surname} ";
$isResponsibleUser = !Yii::$app->user->isGuest && ($task->id_responsible === Yii::$app->user->id);
$isAdmin = !Yii::$app->user->isGuest && Yii::$app->getUser()->identity->id_role === User::ROLE_ADMIN;

?>
<div class="task-board-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if ($isResponsibleUser || $isAdmin): ?>
        <p>
            <?= Html::a('Update', ['update', 'id' => $task->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $task->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $task,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'id_supervisor',
                'value' => $supervisorName,
            ], [
                'attribute' => 'id_responsible',
                'value' => $responsibleName,
            ],
            'deadline',
        ],
    ]) ?>

</div>
