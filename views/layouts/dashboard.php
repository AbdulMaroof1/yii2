<?php

/** @var yii\web\View $this */
/** @var string $content */

use yii\bootstrap5\Html;

$this->title = 'Dashboard';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading"><?= Html::encode(Yii::$app->name) ?></div>
        <div class="list-group list-group-flush">
            <a href="<?= \yii\helpers\Url::to(['site/index']) ?>" class="list-group-item list-group-item-action bg-light">Dashboard</a>
            <a href="<?= \yii\helpers\Url::to(['user/index']) ?>" class="list-group-item list-group-item-action bg-light">Users</a>
            <a href="<?= \yii\helpers\Url::to(['role/index']) ?>" class="list-group-item list-group-item-action bg-light">Roles</a>
            <a href="<?= \yii\helpers\Url::to(['permission/index']) ?>" class="list-group-item list-group-item-action bg-light">Permissions</a>
            <a href="<?= \yii\helpers\Url::to(['site/logout']) ?>" class="list-group-item list-group-item-action bg-light" data-method="post">Logout</a>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <?= $content ?>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
