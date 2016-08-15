<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<article>

    <div class="row">
        <h3><?= Html::encode($model->title) ?></h3>
        <h5><?php echo mb_substr( strip_tags($model->content),0 ,100) . ' ... ' ?></h5>
        <h6><?= $model->created; ?> <?= Yii::t('app', 'by')?> <?= $model->author0->username; ?> | <?= Yii::t('app', 'comments')?> : <?=count($model->comments)?> </h6>

        <?php if ( Yii::$app->user->can('admin') ) : ?>
            <div class="manage">
                <?= Html::a(Yii::t('app', 'Edit'), ['post/edit', 'id' => $model->id], ['class' => 'btn-xs btn-info']) ?>
                |
                <?= Html::a(Yii::t('app', 'Delete'), ['post/delete', 'id' => $model->id], ['class' => 'btn-xs btn-danger']) ?>
            </div>
        <?php endif; ?>

    </div>

</article>