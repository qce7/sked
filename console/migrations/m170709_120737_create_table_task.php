<?php

use yii\db\Migration;

class m170709_120737_create_table_task extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull()->unique(),
            'budget_period' => $this->integer()->unsigned()->notNull(),
            'actual_period' => $this->integer()->unsigned()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->addForeignKey('task_group_id_fk', '{{%task}}', 'group_id', '{{%group}}', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('{{%task}}');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170709_120737_create_table_task cannot be reverted.\n";

        return false;
    }
    */
}
