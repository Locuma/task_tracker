<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use \yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\TaskBoardForm $task */
/** @var app\models\User $users */
/** @var yii\bootstrap5\ActiveForm $form */

$fullUsername = ArrayHelper::map($users, 'id', static function ($data) {
    return "{$data->first_name} {$data->second_name} {$data->surname}";
})

?>

<div class="task-board-form">

    <?php $form = ActiveForm::begin([
        'id' => 'crate-task-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-3 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

    <?= $form->field($task, 'title')->textarea() ?>

    <?= $form->field($task, 'responsible')->dropDownList($fullUsername) ?>

    <?= $form->field($task, 'supervisor')->dropDownList($fullUsername) ?>

    <?= $form->field($task, 'deadline')->textInput(['type' => 'date']) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
