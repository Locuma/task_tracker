<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TaskBoard $model */

$this->title = 'Update Task Board: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Task Boards', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-board-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
