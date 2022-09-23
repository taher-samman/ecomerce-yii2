<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>
    <header class="header">
        <div class="header-top">
            <a href="<?= Url::base() ?>" class="logo">
                <img src="<?= Url::base() . '/assets/images/logo.png' ?>" alt="">
            </a>
            <div class="user">
                <?php
                if (!Yii::$app->user->isGuest) { ?>
                    <p>Logged in by <?= Yii::$app->user->identity->username ?></p>
                    <span class="separator">|</span>
                <?php
                    echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex']);
                    echo Html::submitButton(
                        'Logout out'
                    );
                    echo Html::endForm();
                }
                ?>
            </div>
        </div>
        <div class="header-menu">
            <?php
            NavBar::begin(
                [
                    'options' => [
                        'class' => 'navbar navbar-expand-lg admin-menu',
                    ],
                ]
            );
            $menuItems = [
                ['label' => 'Catalog', 'url' => ['/products/index']],
            ];
            echo Nav::widget([
                'options' => ['class' => 'menu-ul'],
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>
        </div>
    </header>
    <main role="main">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <div class="container">
            <?= Alert::widget() ?>
        </div>
        <?= $content ?>
    </main>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container">
            <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
            <p class="float-end"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
