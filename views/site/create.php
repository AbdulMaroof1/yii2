<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegisterForm */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['users']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-create-user">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-form">

        <?php $form = ActiveForm::begin([
            'action' => ['user/register'], // Specify the route to the actionRegister

        ]); ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'role_id')->dropDownList([1 => 'Admin', 2 => 'User'], ['prompt' => 'Select Role']) ?>

        <div class="form-group">
            <?= Html::submitButton('Create User', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
