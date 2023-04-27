<?php

use app\models\forms\TaskBoardForm;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;

/** @var TaskBoardForm $taskBoardForm */
/** @var app\models\TaskBoard $task */
/** @var app\models\User $users */
/** @var yii\bootstrap5\ActiveForm $form */

$fullUsername = ArrayHelper::map($users, 'id', static function ($data) {
    return "{$data->first_name} {$data->second_name} {$data->surname}";
});

?>

<div class="task-board-form">

    <?php $form = ActiveForm::begin([
        'id' => 'task-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-3 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

    <?= $form->field($taskBoardForm, 'title')->textarea(['value' => $task->title]) ?>

    <?= $form->field($taskBoardForm, 'id_responsible')->dropDownList($fullUsername, ['options' => [
        $task->id_responsible => ['selected' => true]],])->label('Responsible') ?>

    <?= $form->field($taskBoardForm, 'id_supervisor')->dropDownList($fullUsername, ['options' => [
        $task->id_supervisor => ['selected' => true]]])->label('Supervisor') ?>

    <?= $form->field($taskBoardForm, 'deadline')->widget(DatePicker::class, [
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control'],
        'clientOptions' => [
            'minDate' => date('Y-m-d'),
        ],
    ])->textInput(['readonly' => true, 'value' => $task->deadline]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
