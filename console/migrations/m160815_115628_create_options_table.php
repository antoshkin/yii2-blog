<?php

use yii\db\Migration;

/**
 * Handles the creation for table `options`.
 */
class m160815_115628_create_options_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('options', [
            'id' => $this->primaryKey(),
            'option' => $this->string(),
            'value' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('options');
    }
}
