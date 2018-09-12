<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use mdm\admin\components\Helper;
use mdm\admin\components\MenuHelper;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo Html::csrfMetaTags() ?>
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/onelab-api.ico" type="image/x-icon" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="gradient-body skin-blue no-repeat">
    <section id="navigation-main"> 
    <header class="main-header">
        <div class="navbar navbar-btn navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid"> 
                    <div class="nav-collapse skin-blue"> 
                        <?php
                        NavBar::begin([
                            'brandLabel' => '<img src="/images/onelab9.png" alt="" style="width: 130px;padding-top: 0px"/>',
                            'brandUrl' => Yii::$app->homeUrl,
                            'options' => [
                                'class' => 'navbar-blue navbar-fixed-top',
                                'style'=>'margin-top: 10px'
                            ],
                        ]);
                        $mItems = [
                            "<li>"
                            . Html::beginForm(['/'], 'post')
                            . Html::submitButton(
                                    'Home', ['class' => 'btn btn-link text-white logout']
                            )
                            . Html::endForm()
                            . "</li>",
                            Yii::$app->user->can('Access-RBAC') ? (
                            "<li>"
                            . Html::beginForm(['/admin/'], 'post')
                            . Html::submitButton(
                                    'RBAC', ['class' => 'btn btn-link text-white logout']
                            )
                            . Html::endForm()
                            . "</li>") : '',
                            !Yii::$app->user->isGuest ? (
                            "<li>"
                            . Html::beginForm(['/config'], 'post')
                            . Html::submitButton(
                                    'Config', ['class' => 'btn btn-link text-white logout']
                            )
                            . Html::endForm()
                            . "</li>") : '',
                            // ['label' => 'Users', 'url' => ['/site/login'],'linkOptions'=>['class'=>'text-white'],'visible'=>!Yii::$app->user->isGuest],
                            Yii::$app->user->isGuest ? (
                            "<li>"
                            . Html::beginForm(['/site/login'], 'get')
                            . Html::submitButton(
                                    'Login', ['class' => 'btn btn-link text-white logout']
                            )
                            . Html::endForm()
                            . "</li>"
                            ) : (
                            '<li>'
                            . Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                    'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link text-white logout']
                            )
                            . Html::endForm()
                            . '</li>'
                            )
                        ];

                        //$menuItems = Helper::filter($mItems);
                        /* echo Nav::widget([
                          'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id)
                          ]);
                         * 
                         */
                        echo Nav::widget([
                            'options' => ['class' => 'navbar-nav navbar-right'],
                            'items' => $mItems,
                        ]);

                        NavBar::end();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
    </section>
    <div class="wrap" style="padding-top: 50px;padding-left: 20px">
        <?php $this->beginBody() ?>
        <div class="col-lg-11">
        <?= $content ?>
        </div>
    </div>
    <footer class="footer">
        <div class="default">
            <p class="pull-left">&copy; OneLab API <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
