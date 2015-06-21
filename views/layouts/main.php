<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/**
 * @var $this \yii\base\View
 * @var $content string
 */
app\assets\AppAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <title><?= Html::encode($this->title) ?></title>
        <?= Html::csrfMetaTags() ?>
    <?php $this->head(); ?>
</head>
<body>
<?php $this->beginBody(); ?>
    <?php
        NavBar::begin([
            'brandLabel' => \Yii::t('app', 'My Page'),
            'brandUrl' => Yii::$app->user->isGuest ? ['/site/login']:
                ['/users/'.Yii::$app->user->identity->username.''],
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top menu_top',
                //'style' => ' background-color:#00936b;',
            ],
        ]);
        if(Yii::$app->user->identity->username == 'admin'){
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav pull-right'],
                'items' => array_merge([
                  Yii::$app->user->isGuest ?
                    ['label' => \Yii::t('app', 'Новини'), 'url' => ['/post/index']]:
                    ['label' => \Yii::t('app','Новини'), 'url' => ['/feed']],
                    //['label' => 'Головна', 'url' => ['/site/index']],
                    ['label' => \Yii::t('app', 'Адмін Панель'), 'url' => ['/admin/index']],
                    ['label' => \Yii::t('app', 'About Us'), 'url' => ['/site/contact']],
                    ['label' => \Yii::t('app', 'Users'), 'url' => ['/user/index']],
                    ],
                   (Yii::$app->user->isGuest ? [['label' => \Yii::t('app', 'Sign in/Sign up'), 'url' => ['/site/login']]]:
                        [['label' => \Yii::t('app', 'You login as {username}', ['username' => Yii::$app->user->identity->username]),
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']]]))
            ]);
        }else{
            echo Nav::widget([
            'options' => ['class' => 'navbar-nav pull-right'],
            'items' => array_merge([
              Yii::$app->user->isGuest ?
                ['label' => \Yii::t('app', 'Новини'), 'url' => ['/post/index']]:
                ['label' => \Yii::t('app','Новини'), 'url' => ['/feed']],
                //['label' => 'Головна', 'url' => ['/site/index']],
                ['label' => \Yii::t('app', 'About Us'), 'url' => ['/site/contact']],
                ['label' => \Yii::t('app', 'Users'), 'url' => ['/user/index']],
                ],
               (Yii::$app->user->isGuest ? [['label' => \Yii::t('app', 'Sign in/Sign up'), 'url' => ['/site/login']]]:
                    [['label' => \Yii::t('app', 'You login as {username}', ['username' => Yii::$app->user->identity->username]),
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']]]))
        ]);
        }
        NavBar::end();
    ?>
    <!--<div style="min-height: 140px; margin-top:-30px; width:100%; background-color: #B0D0C7; color: #aaaacc;" class="page-header clearfix"></div> -->
    <div class="container">
        <?=Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]); ?>
        <?= $content ?>
    </div>

    <footer style="background-color:transparent;" class="navbar-inverse">
        <div class="container">
            <p class="pull-left">&copy; <?=\Yii::t('app', 'Webstart'); ?> <?= date('Y') ?></p>
        </div>
    </footer>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
