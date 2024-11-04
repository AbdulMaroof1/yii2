<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $users app\models\User[] */
/* @var $pagination yii\data\Pagination */

$this->title = 'User Management';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="user-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= Html::encode($user->id) ?></td>
                    <td><?= Html::encode($user->username) ?></td>
                    <td><?= Html::encode($user->email) ?></td>
                    <td><?= Html::encode($user->role_id == 1 ? 'Admin' : 'User') ?></td>
                    <td>
                        <?= Html::a('View', ['view', 'id' => $user->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Update', ['update', 'id' => $user->id], ['class' => 'btn btn-warning']) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $user->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this user?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="pagination-container">
        <?= LinkPager::widget([
            'pagination' => $pagination,
        ]) ?>
    </div>
</div>
