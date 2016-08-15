<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use frontend\models\SignupForm;


class RbacController extends Controller
{

    public function actionInit()
    {

        $first_admin = $this->createFirstAdmin();
        if ( $first_admin) $this->createRbac( $first_admin );

    }

    public function createFirstAdmin() {

        // -- add first admin user
        $model = new SignupForm(['scenario' => 'first_admin']);

        $model->username = 'admin';
        $model->password = 'admin';
        $model->email    = 'admin@localhost.local';

        return ( $first_admin = $model->signup() ) ?  $first_admin : null;

    }

    public function createRbac( $first_admin ) {

        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // -- create rules
        $ruleM = new \console\rbac\managePostRule();
        $auth->add($ruleM);

        $ruleC = new \console\rbac\createPostRule();
        $auth->add($ruleC);

        // -- create permissions
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $createPost->ruleName = $ruleC->name;
        $auth->add($createPost);

        $managePost = $auth->createPermission('managePost');
        $managePost->description = 'Manage a post';
        $managePost->ruleName = $ruleM->name;
        $auth->add($managePost);

        // -- create roles
        $admin = $auth->createRole('admin');
        $user = $auth->createRole('user');
        $auth->add($admin);
        $auth->add($user);

        // -- create hierarchy
        $auth->addChild($user, $createPost);
        $auth->addChild($user, $managePost);
        $auth->addChild($admin, $user);

        // -- assignments
        $auth->assign($admin, $first_admin->id);
    }




}






