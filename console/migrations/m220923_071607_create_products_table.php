<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m220923_071607_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'sku' => $this->string()->unique()->notNull(),
            'status' => $this->integer(1)->notNull(),
            'description' => $this->text(),
            'price' => $this->float()->notNull(),
            'special_price' => $this->float(),
            'qty' => $this->integer()->notNull(),
            'max_qty_allowed' => $this->integer(),
            'min_qty_allowed' => $this->integer(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products}}');
    }
}
