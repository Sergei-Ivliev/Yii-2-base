<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%activity}}`.
 */
class m190921_082402_create_activity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%activity}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'date_start' => $this->string(),
            'date_end' => $this->string(),
            'user_id' => $this->integer(),
            'description' => $this->text(),
            'repeat' => $this->boolean(),
            'blocked' => $this->boolean(),
        ]);

        $this->addForeignKey(
            'fk_activity_user',
            'activity', 'user_id',
            'user', 'id',
            'cascade'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_activity_user', '{{%activity}}');
        $this->dropTable('{{%activity}}');
    }
}
