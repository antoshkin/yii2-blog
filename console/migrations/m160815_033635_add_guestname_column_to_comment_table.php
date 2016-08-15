<?php

use yii\db\Migration;

/**
 * Handles adding guestname to table `comment`.
 */
class m160815_033635_add_guestname_column_to_comment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('comment', 'guestname', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('comment', 'guestname');
    }
}
