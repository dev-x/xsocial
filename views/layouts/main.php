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
            'brandLabel' => 'Моя Сторінка',
            'brandUrl' => Yii::$app->user->isGuest ? ['/site/login']:
                ['/users/'.Yii::$app->user->identity->username.''],
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
                'style' => ' background-color:#00936b;',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav pull-right'],
            'items' => array_merge([
              /*Yii::$app->user->isGuest ?
                ['label' => 'Home', 'url' => ['/site/login']]:
                ['label' => 'Home', 'url' => ['/users/'.Yii::$app->user->identity->username]],*/
                //['label' => 'Головна', 'url' => ['/site/index']],
                ['label' => 'Пости', 'url' => ['/post/index']],
                ['label' => 'Про нас', 'url' => ['/site/contact']],
                ['label' => 'Користувачі', 'url' => ['/user/index']],

                ],
               // [])

               (Yii::$app->user->isGuest ? [['label' => 'Вхід/Реєстрація', 'url' => ['/site/login']]]:
                    [['label' => 'Ви ввійшли як (' . Yii::$app->user->identity->username .')' ,
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']]]))
        ]);
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
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>