<?php

use yii\widgets\ListView;

/* @var $this yii\web\View */
$this->title = Yii::t('app', 'V-jet Blog');
?>
<div class="site-index">

    <h2 class="post-heading"><?php echo Yii::t('app', 'New posts')?></h2>
    <hr>

    <!-- New posts -->
    <div class="col-md-9">

        <?php
        echo ListView::widget([
            'dataProvider' => $listDataProvider,
            'options' => [
                'tag' => 'div',
                'class' => 'list-wrapper',
                'id' => 'list-wrapper',
            ],
            'layout' => "{items}\n{pager}\n",
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_one_post',['model' => $model]);
            },
        ]);
        ?>

        <hr>

        <?php echo $this->render('createPostForm', ['post' => $post]);?>


    </div>

    <!-- Sidebar -->
    <div class="col-md-3">
        <div class="sidebar">Recent comments sidebar</div>
    </div>

</div>
