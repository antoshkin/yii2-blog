<?php

use yii\db\Migration;

/**
 * Handles the creation for table `post`.
 */
class m160814_154458_create_post_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->unique(),
            'content' => $this->text(),
            'created' => $this->dateTime(),
            'author' => $this->integer(),
        ]);

        $this->addForeignKey(
            'FK_post_author', 'post', 'author', 'user', 'id', 'SET NULL', 'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('post');
    }
}
