<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var app\models\User[] $users */
/** @var yii\data\Pagination $pagination */

$this->title = 'User List';
?>

<h1><?= Html::encode($this->title) ?></h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= Html::encode($user->id) ?></td>
                <td><?= Html::encode($user->username) ?></td>
                <td><?= Html::encode($user->email) ?></td>
                <td>
                    <?= Html::a('View', ['view', 'id' => $user->id]) ?>
                    <?= Html::a('Edit', ['update', 'id' => $user->id]) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $user->id], [
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

<div class="pagination">
    <?= LinkPager::widget([
        'pagination' => $pagination, // Use the pagination variable passed from the controller
    ]); ?>
</div>
