<?php
use Yii;
use yii\widgets\ListView;

$this->title = $post->title;
?>

<!-- Display content -->
<?=$post->content;?>

<br>
<h6><?= $post->created; ?> <?= Yii::t('app', 'by')?> <?= $post->author0->username; ?></h6>
<hr>

<div class="row"><h3><?php echo Yii::t('app', 'Comments')?></h3></div>


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
        return $this->render('_one_comment_list',['model' => $model]);
    },
]);
?>

<hr>
<?php echo $this->render('createCommentForm', ['comment' => $comment, 'author' => $commentAuthor, 'post' => $post->id] );?>
