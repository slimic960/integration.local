<?php
namespace frontend\controllers;

use common\models\MenuSearch;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Menu;
use common\models\AuthAssignment;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\Callcenter;
use yii\data\Pagination;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
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

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        $query  = callcenter::find();

        $pagination = new Pagination([
            'defaultPageSize' => 50,
            'totalCount' => $query->count(),
        ]);

        $callcenter_name = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'callcenter_name' => $callcenter_name,
            'pagination' => $pagination,
        ]);

    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays menu page.
     *
     * @return mixed
     */
    public function actionMenu()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $searchModelMenu = new MenuSearch();
        $dataProviderMenu = $searchModelMenu->search(Yii::$app->request->queryParams);
        $dataProviderMenu->pagination->pageSize=15;
        $modelMenu = new Menu();

        return  $this->render('menu', compact(
            'searchModelMenu',
            'dataProviderMenu',
            'modelMenu',
            'modelMenuAuth'
        ));
    }

    public function actionMenuUpdate($id)
    {
        $modelMenu = $this->findModelMenu($id);

        if ($modelMenu->load(Yii::$app->request->post()) && $modelMenu->save()) {
//        $userRole = Yii::$app->authManager->getRole('admin');
//        Yii::$app->authManager->assign($userRole, $id);
            return $this->redirect(['index']);
        } else {
            return $this->render('menuUpdate', [
                'modelMenu' => $modelMenu,
            ]);
        }
    }


    public function actionAuthUpdate($id)
    {
        $modelMenuAuth = $this->findModelMenuAuth($id);
        foreach ($modelMenuAuth as $k=>$t) {
            if ($t->save()) {
//        $userRole = Yii::$app->authManager->getRole('admin');
//        Yii::$app->authManager->assign($userRole, $id);
                return $this->redirect(['menu']);
            } else {
                return $this->render('authUpdate', [
                    'modelMenuAuth' => $modelMenuAuth,
                ]);
            }
        }
    }


    protected function findModelMenu($id)
    {
        if (($modelMenu = Menu::findOne($id)) !== null) {
            return $modelMenu;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelMenuAuth($id)
    {
        if (($modelMenuAuth = AuthAssignment::findAll([
                'user_id' => $id,
            ])) !== null) {
            return $modelMenuAuth;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionRole($id){
//        $admin = Yii::$app->authManager->createRole('admin');
//        $admin->description = 'Администратор';
//        Yii::$app->authManager->add($admin);
//
//        $content = Yii::$app->authManager->createRole('content');
//        $content->description = 'content';
//        Yii::$app->authManager->add($content);
//
//        $user = Yii::$app->authManager->createRole('userKazeco');
//        $user->description = 'UserKazeco';
//        Yii::$app->authManager->add($user);
//
//        $ban = Yii::$app->authManager->createRole('ban');
//        $ban->description = 'ban';
//        Yii::$app->authManager->add($ban);
//
//        $permit = Yii::$app->authManager->createPermission('viewIndexKazeco');
//        $permit->description = 'Право на просмотр Kazeco';
//        Yii::$app->authManager->add($permit);
//
//        $role_a = Yii::$app->authManager->getRole('userKazeco');
//        $permit = Yii::$app->authManager->getPermission('viewIndexKazeco');
//        Yii::$app->authManager->addChild($role_a, $permit);

//        $userRole = Yii::$app->authManager->getRole('userKazeco');
//        Yii::$app->authManager->assign($userRole, Yii::$app->user->getId());

        return 123;
    }
}

