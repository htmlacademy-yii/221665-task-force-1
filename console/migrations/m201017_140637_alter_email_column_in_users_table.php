<?php

use yii\db\Migration;

/**
 * Class m201017_140637_alter_email_column_in_users_table
 */
class m201017_140637_alter_email_column_in_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%users}}', 'email', 'string unique');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201017_140637_alter_email_column_in_users_table cannot be reverted.\n";

        return false;
    }

}
