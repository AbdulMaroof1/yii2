<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegisterForm;
use yii\data\Pagination;
use app\models\User;

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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new LoginForm();

        return $this->render('login',[
            'model' => $model
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['dashboard']);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays the registration page.
     *
     * @return Response|string
     */
    public function actionRegister()
    {
        $model = new RegisterForm();

        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            Yii::$app->session->setFlash('registrationSuccessful');
            return $this->redirect(['login']);
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays the dashboard.
     *
     * @return string
     */
    public function actionDashboard()
    {
        return $this->render('dashboard/index');
    }

    // Users Actions

    /**
     * Displays a list of users with pagination.
     *
     * @return string
     */
    public function actionUsers()
    {
        $query = User::find(); // Create a query for the User model

        // Set up pagination
        $pagination = new Pagination([
            'defaultPageSize' => 10, // Number of items per page
            'totalCount' => $query->count(), // Total count of users
        ]);

        // Fetch the users with pagination
        $users = $query->orderBy('id') // Order the results
                    ->offset($pagination->offset) // Apply offset for pagination
                    ->limit($pagination->limit) // Limit the results to the current page
                    ->all();

        // Render the view with users and pagination info
        return $this->render('users', [
            'users' => $users, // Pass the users to the view
            'pagination' => $pagination, // Pass the pagination to the view
        ]);
    }

    /**
     * Displays a single user.
     *
     * @param integer $id
     * @return string
     */
    public function actionView($id)
    {
        $user = $this->findUser($id);
        return $this->render('view', ['user' => $user]);
    }

    /**
     * Updates an existing user.
     *
     * @param integer $id
     * @return Response|string
     */
    public function actionUpdate($id)
{
    $model = $this->findModel($id);

    if ($model->load(Yii::$app->request->post())) {
        Yii::info('Loaded Model Data: ' . print_r($model->attributes, true), __METHOD__);

        if (!$model->validate()) {
            Yii::error('Validation Errors: ' . print_r($model->errors, true), __METHOD__);
            return $this->render('update', ['model' => $model]);
        }

        if ($model->save()) {
            Yii::info('User Updated: ' . print_r($model->attributes, true), __METHOD__);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            Yii::error('Failed to save user: ' . print_r($model->errors, true), __METHOD__);
        }
    }

    return $this->render('update', ['model' => $model]);
}

    /**
     * Deletes an existing user.
     *
     * @param integer $id
     * @return Response
     */
    public function actionDelete($id)
    {
        $this->findUser($id)->delete();
        return $this->redirect(['users']);
    }
    
    /**
     * Finds a User model by its primary key.
     *
     * @param integer $id
     * @return User|null
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findUser($id)
    {
        if (($user = User::findOne($id)) !== null) {
            return $user;
        }

        throw new NotFoundHttpException('The requested user does not exist.');
    }
    public function actionCreate()
    {
    $model = new RegisterForm(); // Assuming you are using the same RegisterForm model

    if ($model->load(Yii::$app->request->post()) && $model->register()) {
        // If registration is successful, redirect to the users list
        return $this->redirect(['users']);
    }

    return $this->render('create', [
        'model' => $model,
    ]);
    }

    public function actionProfile()
    {
        $user = Yii::$app->user->identity; // Get the current logged-in user
    
        return $this->render('profile', [
            'user' => $user, // Pass the user data to the view
        ]);
    }

public function actionUpdateProfile()
{
    $user = Yii::$app->user->identity; // Get the current logged-in user

    if ($user->load(Yii::$app->request->post()) && $user->save()) {
        Yii::$app->session->setFlash('success', 'Profile updated successfully.');
        return $this->redirect(['profile']); // Redirect to the profile page
    }

    return $this->render('update_profile', [
        'user' => $user, // Pass the user data to the view
    ]);
}
    
}
