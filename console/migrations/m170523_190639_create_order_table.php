<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m170523_190639_create_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer()->notNull(),
            'created_at'=>$this->dateTime()->notNull(),
            'address'=>$this->string()->notNull(),
        ]);
        $this->createIndex('order_user_id_index', 'order', 'user_id');
        $this->addForeignKey('fk_order_user_id', 'order', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_order_user_id', 'order');
        $this->dropTable('order');
    }
}
