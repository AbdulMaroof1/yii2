<?php
use yii\helpers\Html; // Make sure to include this line

/* @var $this yii\web\View */
/* @var $user app\models\User */

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>Username: <?= Html::encode($user->username) ?></p>
<p>Email: <?= Html::encode($user->email) ?></p>

<!-- Link to Update Profile -->
<?= Html::a('Update Profile', ['update-profile'], ['class' => 'btn btn-primary']) ?>
