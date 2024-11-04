<?php
namespace app\controllers;

use Yii;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\RegisterForm;
use yii\data\ActiveDataProvider;

class UserController extends Controller
{
    public function actionRegister()
    {
        $model = new RegisterForm();

        if ($model->load(Yii::$app->request->post())) {
            // Create a new User object
            $user = new User();
            $user->username = $model->username;
            $user->email = $model->email;
            $user->role_id = $model->role_id?$model->role_id : 2; // Set the role_id to 1 for admin, adjust as needed

            $user->password = Yii::$app->security->generatePasswordHash($model->password);
            $user->generateAuthKey(); // Ensure you have this method in your User model
            if ($user->save()) {
                // Optionally: login the user or redirect
                return $this->redirect(['site/index']); // Redirect after successful registration
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }



    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

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
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['users']);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
?>