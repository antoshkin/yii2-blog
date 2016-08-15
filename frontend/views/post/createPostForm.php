<?php
use vova07\imperavi\Widget as Redactor;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\User;
use yii\helpers\Url;
?>

<div class="row"><h3><?php echo Yii::t('app', 'Create new post')?></h3></div>

<div class="row">
    <?php $form = ActiveForm::begin(['action' => ['post/create']]); ?>

    <?php if (Yii::$app->user->can('admin')) : ?>
        <?= $form->field($post, 'author')->dropDownList(
            ArrayHelper::map(User::find()->select( ['id','username'] )->all(), 'id', 'username')
        ) ?>
    <?php else: ?>
        <?= $form->field($post,'author')->hiddenInput(['value' => Yii::$app->user->getId()])->label(false); ?>
    <?php endif;?>

    <?= $form->field($post, 'title')->textInput(); ?>

    <!-- Imperavi redactor -->
    <?php
    echo $form->field($post, 'content')->widget(Redactor::className(), [
        'settings' => [
            'lang' => 'en',
            'minHeight' => 200,
            'plugins' => [
                'clips',
                'fullscreen',
            ],
            'imageUpload' => Url::toRoute(['site/image-upload']),
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create post'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>