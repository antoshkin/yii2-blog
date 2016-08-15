<?php

namespace console\rbac;
use yii\rbac\Rule;
use common\models\Post;

class managePostRule extends Rule
{
    public $name = 'managePostRule';

    public function execute($user, $item, $params)
    {
        $exist = Post::find()->where(['author' => $user,'id' => $params['post_id']])->count();
        return $exist ? true : false;

    }
}