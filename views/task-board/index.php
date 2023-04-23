<?php

use app\models\forms\TaskBoardSearchForm;
use app\models\User;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\jui\DatePicker;


/** @var yii\web\View $this */
/** @var app\models\TaskBoard $tasks */
/** @var TaskBoardSearchForm $dataProvider */
/** @var TaskBoardSearchForm $searchModel */

$this->title = 'Task Boards';
$this->params['breadcrumbs'][] = $this->title;

$user = Yii::$app->getUser()->identity;
$isAdmin = !Yii::$app->user->isGuest && Yii::$app->getUser()->identity->id_role === 2;

?>
<div class="task-board-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Task Board', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('My tasks', ['my-task'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php if ($isAdmin): ?>

        <h1> *********************</h1>
        <h1> Типа админская панель</h1>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'attribute' => 'title',
                    'filterInputOptions' => ['placeholder' => 'Title'],
                ],
                [
                    'attribute' => 'id_supervisor',
                    'filterInputOptions' => ['placeholder' => 'Supervisor'],
                    'value' => function ($task) {
                        return "{$task->supervisor->first_name} {$task->supervisor->second_name} {$task->supervisor->surname}";
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'id_supervisor', ArrayHelper::map(User::find()->all(), 'id',
                        function ($responsible) {
                            return "{$responsible->first_name} {$responsible->second_name} {$responsible->surname}";
                        }

                    ), ['class' => 'form-control', 'prompt' => '']),
                ],
                [
                    'attribute' => 'id_responsible',
                    'filterInputOptions' => ['placeholder' => 'Responsible'],
                    'value' => function ($model) {
                        return "{$model->responsible->first_name} {$model->responsible->second_name} {$model->responsible->surname}";
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'id_responsible', ArrayHelper::map(User::find()->all(), 'id', function ($responsible) {
                        return "{$responsible->first_name} {$responsible->second_name} {$responsible->surname}";
                    }), ['class' => 'form-control', 'prompt' => '']),
                ],
                [
                    'attribute' => 'deadline',
                    'filterInputOptions' => ['placeholder' => 'Deadline'],
                    'value' => function ($model) {
                        return Yii::$app->formatter->asDate($model->deadline, 'php:d.m.Y');
                    },
                    'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'deadline',
                        'dateFormat' => 'yyyy-MM-dd',
                        'options' => ['class' => 'form-control'],
                        'clientOptions' => [
                            'minDate' => date('Y-m-d'),
                        ],
                    ]),
                ],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        <h1> Конец типа админской панели</h1>
        <h1> ***************************</h1>
    <?php endif; ?>

    <?php

    if (!empty($tasks)) : ?>
        <?php foreach ($tasks as $task): ?>

            <?php $supervisorName = "{$task->supervisor->first_name} {$task->supervisor->second_name} {$task->supervisor->surname} ";
            $responsibleName = "{$task->responsible->first_name} {$task->responsible->second_name} {$task->responsible->surname} "; ?>

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

            <?php
            if (!Yii::$app->user->isGuest && ($task->id_responsible === Yii::$app->user->id) || $isAdmin) { ?>
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
            <?php } ?>

        <?php endforeach; ?>
    <?php endif; ?>

</div>
