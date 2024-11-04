<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $user */

$this->title = 'Update User: ' . $user->username;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($user, 'username')->textInput(['maxlength' => true]) ?>
    <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($user, 'role_id')->dropDownList([1 => 'Admin', 2 => 'Normal User']) ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
