<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\User $user */

$this->title = 'View User: ' . $user->username;
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <strong>ID:</strong> <?= Html::encode($user->id) ?><br>
    <strong>Username:</strong> <?= Html::encode($user->username) ?><br>
    <strong>Email:</strong> <?= Html::encode($user->email) ?><br>
</p>

<?php if (Yii::$app->user->identity->role_id == 2 && Yii::$app->user->identity->id == $user->id): ?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $user->id], ['class' => 'btn btn-primary']) ?>
    </p>
<?php endif; ?>

<p>
    <?= Html::a('Back to Users', ['users'], ['class' => 'btn btn-secondary']) ?>
</p>
