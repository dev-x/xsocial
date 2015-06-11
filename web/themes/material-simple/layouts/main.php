<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;

/**
 * @var $this \yii\base\View
 * @var $content string
 */
// $this->registerAssetBundle('app');
?>
<?php $this->beginPage(); ?>

<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo Html::encode($this->title); ?></title>
    <?php $this->head(); ?>
    
		<meta name="description" content="" />
		<meta name="HandheldFriendly" content="True" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme->baseUrl ?>/assets/font/font-awesome/css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme->baseUrl ?>/assets/css/materialize.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme->baseUrl ?>/assets/css/prism.css" />
</head>
<body class="post-template page-template page grey lighten-5">
  <?php $this->beginBody() ?>
	<nav>
		<div class="nav-wrapper cyan darken-3">
	  		<?php
						echo Menu::widget([
						    'options' => ['id' => "nav-mobile", 'class' => 'left side-nav'],
						    'items' => [
						        ['label' => 'Home', 'url' => ['site/index']],
						        ['label' => 'About', 'url' => ['site/about']],
						        ['label' => 'Contact', 'url' => ['site/contact']],
						        ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
						    ],
						]);
					?>
			<a class="button-collapse" href="#" data-activates="nav-mobile"><i class="mdi-navigation-menu"></i></a>
		</div>
	</nav>

		

<main class="content" role="main">
		<section id="blog-intro" class="cyan section z-depth-1 article-intro" style="background-image:url('<?php echo $this->theme->baseUrl ?>/assets/images/post.jpg?v=b2f76a195e');"></section>
	<section id="main-inner-container" class="container">
		<article class="post page card-panel z-depth-1 article-container">
			<header>
				<time class="post-date grey-text" datetime="2014-03-17"><i class="fa fa-clock-o"></i> 17 March 2014</time>
				<h1><?php echo Html::encode(\Yii::$app->name); ?></h1>
			</header>
			<section class="post-content">
				<p>
          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
				</p>
				<p>
				  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
				</p>
			</section>
			
			<section class="post-content">
				<?php echo $content; ?>
			</section>
			<footer>
				<section id="social-share">
					<p>
						Share this post: <br>
						<a href="#" class="btn-floating white cyan-text"><i class="fa fa-twitter cyan-text"></i></a>
						<a href="#" class="btn-floating white cyan-text"><i class="fa fa-facebook cyan-text"></i></a>
						<a href="#" class="btn-floating white cyan-text"><i class="fa fa-google-plus cyan-text"></i></a>
					</p>
				</section>
			</footer>
		</article>
	</section>
</main>



		<footer class="site-footer clearfix">
			 <section class="copyright grey-text darken-2"><a href="/" class="grey-text darken-5"><?php echo Html::encode($this->title); ?></a> &copy; 2015</section>
			 <section class="poweredby grey-text darken-2">proudly published with <a href="http://yiiframework.com" class="grey-text darken-5">Yii2</a></section>
		</footer>

		<script src="<?php echo $this->theme->baseUrl ?>/assets/js/jquery.min.js"></script>


		<script type="text/javascript" src="<?php echo $this->theme->baseUrl ?>/assets/js/materialize.js"></script>
		<script type="text/javascript" src="<?php echo $this->theme->baseUrl ?>/assets/js/prism.js"></script>
  <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage(); ?>