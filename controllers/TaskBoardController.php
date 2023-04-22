<?php

namespace app\controllers;

use app\models\Role;
use app\models\TaskBoard;
use app\models\TaskBoardForm;
use app\models\User;
use Yii;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

class TaskBoardController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex(): string
    {

        return $this->render('index', [
        ]);
    }

    /**
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionCreate(): string|Response
    {
        $taskBoardForm = new TaskBoardForm();
        $task = new TaskBoard();

        if ($this->request->isPost &&
            $taskBoardForm->load(Yii::$app->request->post()) &&
            $taskBoardForm->validate()) {

            $task->fillTaskBoard($taskBoardForm);
            $task->save();

            return $this->redirect(['view', 'id' => $task->id]);
        }

        $users = User::find()->all();

        return $this->render('create', [
            'task' => $taskBoardForm,
            'users' => $users
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id): string|Response
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id): string|Response
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): TaskBoard
    {
        if (($model = TaskBoard::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
