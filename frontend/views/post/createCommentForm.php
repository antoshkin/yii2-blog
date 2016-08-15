<?php
use vova07\imperavi\Widget as Redactor;

use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="row"><h3><?php echo Yii::t('app', 'Add comment')?></h3></div>

<div class="row">
    <?php $form = ActiveForm::begin(['action' => ['post/addcomment']]); ?>

    <?= $form->field($comment,'author')->hiddenInput(['value' => $author])->label(false); ?>
    <?= $form->field($comment,'post')->hiddenInput(['value' => $post])->label(false); ?>

    <?php if (Yii::$app->user->isGuest) : ?>
        <?php echo $form->field($comment,'guestname')->textInput(); ?>
    <?php endif; ?>

    <!-- Imperavi redactor -->
    <?php
    echo $form->field($comment, 'content')->widget(Redactor::className(), [
        'settings' => [
            'lang' => 'en',
            'minHeight' => 200,
            'toolbar' => false,
            'paragraphize' => false,
            'plugins' => [
                'clips',
                'fullscreen',
            ],
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Comment post'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>