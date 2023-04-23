<?php

use app\models\forms\TaskBoardForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var TaskBoardForm $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="task-board-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'id_supervisor') ?>

    <?= $form->field($model, 'id_responsible') ?>

    <?= $form->field($model, 'deadline') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>