<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%responses}}`.
 */
class m200930_145958_add_created_column_to_responses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%responses}}', 'created', $this->datetime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%responses}}', 'created');
    }
}
