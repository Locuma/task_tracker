<?php

use app\models\forms\UserSearchForm;
use app\models\Role;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/** @var UserSearchForm $searchUserModel */
/** @var UserSearchForm $userDataProvider */
?>

<div class="admin">

    <h1>Tasks</h1>
    <?= GridView::widget([
        'dataProvider' => $userDataProvider,
        'filterModel' => $searchUserModel,
        'columns' => [
            [
                'attribute' => 'id',
                'filterInputOptions' => ['placeholder' => 'id'],
            ],
            [
                'attribute' => 'login',
                'filterInputOptions' => ['placeholder' => 'Login'],
            ],
            [
                'attribute' => 'first_name',
                'filterInputOptions' => ['placeholder' => 'First name'],
            ],
            [
                'attribute' => 'second_name',
                'filterInputOptions' => ['placeholder' => 'Second name'],
            ],
            [
                'attribute' => 'surname',
                'filterInputOptions' => ['placeholder' => 'Surname'],
            ],
            [
                'attribute' => 'id_role',
                'format' => 'raw',
                'filterInputOptions' => ['placeholder' => 'Role'],
                'value' => function ($searchUserModel) {
                    return Html::activeDropDownList($searchUserModel, 'id_role', ArrayHelper::map(Role::find()->all(), 'id', function ($role) {
                        return $role->name;
                    }), ['class' => 'form-control', 'onchange' => "updateRecord(this, $searchUserModel->id)", 'prompt' => '']);
                },
                'label' => 'Role',

                'filter' => Html::activeDropDownList($searchUserModel, 'id_role', ArrayHelper::map(Role::find()->all(), 'id', function ($role) {
                    return $role->name;
                }), ['class' => 'form-control', 'prompt' => '']),
            ],
        ],
    ]); ?>
</div>