<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\models\Options;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Blog',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => Yii::t('app', 'Parser'), 'url' => ['/parser/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>

        <div class="site-index">

            <h2 class="post-heading"><?php echo $this->title;?></h2>
            <hr>

            <div class="col-md-9">
                <?= $content ?>
            </div>

            <!-- Sidebar -->
            <div class="col-md-3" style="border-left: 1px solid #cfcfcf;">
                <div class="sidebar">
                    <?php  $count = (int)Options::findOne(['option'=>'popular_count'])->value; ?>
                    <?= \frontend\widgets\Popular::widget(['count' => $count]) ?>
                </div>
            </div>

        </div>


    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; v-jet test task by i.antoshkin <?= date('Y') ?></p>

        <p class="pull-right">
            <?php
            $preset_lang=Yii::$app->session->has('lang') ? Yii::$app->session->get('lang') : substr(Yii::$app->request->getPreferredLanguage(),0,2);
            $langs=array('ru'=> Yii::t('app', 'Русский'), 'en'=> 'English');

            foreach( $langs as $code=>$val )
            {
                if ($code==$preset_lang) continue;
                echo Html::a( $val, ['site/lang', 'id' => $code], ['class' => 'btn-link']);
            }
            ?>
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
