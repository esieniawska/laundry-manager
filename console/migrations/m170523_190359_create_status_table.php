<?php

use yii\db\Migration;

/**
 * Handles the creation of table `status`.
 */
class m170523_190359_create_status_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('status', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('status');
    }
}
