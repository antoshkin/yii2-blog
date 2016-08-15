<?php

namespace console\rbac;
use yii\rbac\Rule;

class createPostRule extends Rule
{
    public $name = 'createPostRule';

    public function execute($user, $item, $params)
    {

        return ! \Yii::$app->user->isGuest ? true : false ;

    }
}