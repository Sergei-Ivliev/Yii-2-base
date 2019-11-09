<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%update_activity}}`.
 */
class m190924_170644_create_update_activity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('activity', 'created_at', $this->integer());
        $this->addColumn('activity', 'updated_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('activity', 'created_at');
        $this->dropColumn('activity', 'updated_at');
    }
}
