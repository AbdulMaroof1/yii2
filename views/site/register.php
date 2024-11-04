    <?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    /* @var $this yii\web\View */
    /* @var $model app\models\User */ // Assuming User model will be used for registration
    /* @var $form yii\widgets\ActiveForm */

    $this->title = 'Register';
    $this->params['breadcrumbs'][] = $this->title;
    ?>

    <div class="site-register">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Please fill out the following fields to register:</p>

        <?php $form = ActiveForm::begin([
            'action' => ['user/register'], // Specify the route to the actionRegister
        ]); 
        ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'email')->input('email') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
