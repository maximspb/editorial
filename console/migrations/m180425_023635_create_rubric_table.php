<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rubric`.
 */
class m180425_023635_create_rubric_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('rubric', [
            'id' => $this->primaryKey(),
            'slug'=>$this->string()->unique(),
            'rubric_title'=>$this->string()->unique(),
            'theme_id'=>$this->integer()
        ]);

        $this->addForeignKey(
            'fk_rubric_theme_id',
            'rubric',
            'theme_id',
            'theme',
            'id',
            'SET NULL',
            'CASCADE'

        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('rubric');
    }
}
