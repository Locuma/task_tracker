<?php

namespace app\controllers;

use app\models\forms\LoginForm;
use app\models\forms\SignUpForm;
use app\models\forms\UserSearchForm;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'admin'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                    [
                        'actions' => ['admin'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->getUser()->identity->id_role === 2;
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex(): string
    {
        return $this->render('index');
    }

    public function actionLogin(): string|Response
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignUp(): string|Response
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new SignUpForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = new User();
            $user->fillUser($model);
            $user->save();
            Yii::$app->user->login($user);

            return $this->goBack();
        }

        $model->password = '';
        return $this->render('signUp', [
            'model' => $model,
        ]);
    }

    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionAdmin(): string
    {
        $searchTaskModel = new UserSearchForm();
        $taskDataProvider = $searchTaskModel->search($this->request->queryParams);


        return $this->render('admin', [
            'searchUserModel' => $searchTaskModel,
            'userDataProvider' => $taskDataProvider,]);
    }

    public function actionUpdateRole(): string|bool
    {
        if (Yii::$app->request->isPost) {
            $roleId = (int)Yii::$app->request->post('roleId');
            $userId = (int)Yii::$app->request->post('userId');

            if (empty($roleId)){
                return "You can't leave user without role!";
            }

            $user = User::findOne($userId);
            $user->id_role = $roleId;

            if(!$user->save()) {
                return false;
            }
        }
        return "Role changed!";
    }
}
