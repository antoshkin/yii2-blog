<?php

use yii\db\Migration;

class m160815_120712_insert_options_values extends Migration
{
    public function up()
    {
        $this->insert('options', [
            'option' => 'percent',
            'value' => 5,
        ]);

        $this->insert('options', [
            'option' => 'popular_count',
            'value' => 5,
        ]);

    }

    public function down()
    {
        $this->delete('options',['option' => 'percent']);
        $this->delete('options',['option' => 'popular_count']);
    }


}
