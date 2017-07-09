<?php

use yii\db\Migration;

class m170709_120750_create_table_period extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%period}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'start_at' => $this->integer()->notNull(),
            'end_at' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->addForeignKey('period_task_id_fk', '{{%period}}', 'task_id', '{{%task}}', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('{{%period}}');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170709_120750_create_table_period cannot be reverted.\n";

        return false;
    }
    */
}
