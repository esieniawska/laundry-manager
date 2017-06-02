<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_product`.
 */
class m170523_191811_create_order_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('order_product', [
            'id' => $this->primaryKey(),
            'order_id'=>$this->integer()->notNull(),
            'product_id'=>$this->integer()->notNull(),
            'amount'=>$this->integer()->notNull(),
        ],$tableOptions);
        $this->createIndex('order_product_order_id_index', 'order_product', 'order_id');
        $this->createIndex('order_product_product_id_index', 'order_product', 'product_id');

        $this->addForeignKey('fk_order_product_order_id', 'order_product', 'order_id', 'order', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_order_product_product_id', 'order_product', 'product_id', 'product', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_order_product_order_id', 'order_product');
        $this->dropForeignKey('fk_order_product_product_id', 'order_product');
        $this->dropTable('order_product');
    }
}
