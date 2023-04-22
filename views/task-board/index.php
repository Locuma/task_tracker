<?php

use app\models\TaskBoard;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TaskBoardForm $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Task Boards';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-board-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Task Board', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

</div>
