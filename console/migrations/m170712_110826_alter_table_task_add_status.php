<?php

use yii\db\Migration;

class m170712_110826_alter_table_task_add_status extends Migration
{
    public function safeUp()
    {

        $this->addColumn('{{%task}}', 'status', 'tinyint');
    }

    public function safeDown()
    {
        echo "m170712_110826_alter_table_task_add_status cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170712_110826_alter_table_task_add_status cannot be reverted.\n";

        return false;
    }
    */
}
