<?php

use yii\db\Migration;

/**
 * таблица для сообщений из формы обратной связи
 * Handles the creation of table `feedback`.
 */
class m180425_051059_create_feedback_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('feedback', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(),
            'email'=>$this->string()->notNull(),
            'text' =>$this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('feedback');
    }
}
