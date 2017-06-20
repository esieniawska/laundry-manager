<?php

use yii\db\Migration;

/**
 * Handles adding position to table `order`.
 */
class m170620_103939_add_position_column_to_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('order', 'updated_by', $this->integer()->after("user_id"));
        $this->addForeignKey('fk_order_updated_by', 'order', 'updated_by', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('order','updated_by');
        $this->dropForeignKey('fk_order_updated_by','order');
    }
}
