<?php

use yii\db\Migration;

/**
 * Handles the creation for table `comment`.
 */
class m160814_155121_create_comment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {

        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'content' => $this->text(),
            'created' => $this->dateTime(),
            'author' => $this->integer(),
            'post' => $this->integer(),
        ]);

        $this->addForeignKey(
            'FK_comment_author', 'comment', 'author', 'user', 'id', 'SET NULL', 'CASCADE'
        );

        $this->addForeignKey(
            'FK_comment_post', 'comment', 'post', 'post', 'id', 'SET NULL', 'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('comment');
    }
}