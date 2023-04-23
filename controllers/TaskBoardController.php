<?php

namespace app\controllers;

use app\models\forms\TaskBoardForm;
use app\models\forms\TaskBoardSearchForm;
use app\models\TaskBoard;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class TaskBoardController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $searchModel = new TaskBoardSearchForm();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'tasks' => TaskBoard::find()->all(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'task' => $this->findModel($id),
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

        return $this->render('create', [
            'taskBoardForm' => $taskBoardForm,
            'task' => $task,
            'users' => User::find()->all(),
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id): string|Response
    {
        $task = TaskBoard::findOne($id);
        $taskBoardForm = new TaskBoardForm();

        if ($this->request->isPost &&
            $taskBoardForm->load(Yii::$app->request->post()) &&
            $taskBoardForm->validate()) {

            $task->fillTaskBoard($taskBoardForm);
            $task->save();

            return $this->redirect(['view', 'id' => $task->id]);
        }

        return $this->render('update', [
            'task' => $task,
            'users' => User::find()->all(),
            'taskBoardForm' => $taskBoardForm,
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

    public function actionMyTask(): string
    {
        $searchModel = new TaskBoardSearchForm();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'tasks' => TaskBoard::find()->where(['id_responsible' => \Yii::$app->user->identity->id])->all(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
