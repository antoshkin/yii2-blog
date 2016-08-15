<article>

    <div class="row">
        <h4><?= $model->guestname ? $model->guestname : $model->author0->username; ?></h4>
        <h5><?= $model->content;?></h5>
        <h6><?= $model->created; ?>
        </h6>
    </div>

</article>