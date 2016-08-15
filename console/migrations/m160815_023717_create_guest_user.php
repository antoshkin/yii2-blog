<?php

use yii\db\Migration;

class m160815_023717_create_guest_user extends Migration
{
    public function up()
    {
        $this->insert('user', [
            'username' => 'guest',
            'auth_key' => '',
            'password_hash' => Yii::$app->security->generatePasswordHash('guest'),
            'email' => 'guest@localhost.local',
            'status' => '10',
        ]);
    }


    public function down()
    {
        $this->delete('user', 'username = "guest"');
    }

}




