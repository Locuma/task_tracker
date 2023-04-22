<?php

/** @var yii\web\View $this */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/** @var \app\models\TaskBoard $tasks */

$this->title = 'My Yii Application';

?>
<div class="site-index">

    <?php
    if (empty($tasks)) { ?>
        <?= Html::button('Добавить форму', ['id' => 'add-form-btn', 'class' => 'btn btn-primary']) ?>
    <?php } else { ?>

        <?php $form = ActiveForm::begin(['action' => '/assignments']); ?>

        <?= $form->field($tasks, 'title')->textInput() ?>

        <?= $form->field($tasks, 'responsible')->textInput() ?>

        <?= $form->field($tasks, 'supervisor')->textInput() ?>

        <?= $form->field($tasks, 'deadline')->textInput(['type' => 'date']) ?>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    <?php } ?>

</div>
