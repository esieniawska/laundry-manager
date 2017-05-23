<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_status`.
 */
class m170523_191149_create_order_status_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order_status', [
            'id' => $this->primaryKey(),
            'order_id'=>$this->integer()->notNull(),
            'status_id'=>$this->integer()->notNull(),
            'created_at'=>$this->dateTime()->notNull(),
        ]);

        $this->createIndex('order_status_status_id_index', 'order_status', 'status_id');
        $this->createIndex('order_status_order_id_index', 'order_status', 'order_id');

        $this->addForeignKey('fk_order_status_status_id', 'order_status', 'status_id', 'status', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_order_status_order_id', 'order_status', 'order_id', 'order', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_order_status_status_id','order_status');
        $this->dropForeignKey('fk_order_status_order_id','order_status');
        $this->dropTable('order_status');
    }
}
