<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'password_hash')->textInput() ?>

    <!-- Hard trick, sorry:) -->
    <?php if ( 'guest' != $model->username ) : ?>
    <div class="form-group">
        <?php
            $auth = Yii::$app->authManager;
            $role = key($auth->getRolesByUser($model->id));
        ?>
        <br>
        <?= Html::label(Yii::t('app', 'Role'),'roleSelector')?><br>
        <?= Html::dropDownList('role', $role, ['user'=>'User','admin' => 'Admin'], ['id'=>'roleSelector']) ?>
    </div>
    <?php endif;;?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
