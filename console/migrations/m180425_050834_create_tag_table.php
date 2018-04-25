<?php

use yii\db\Migration;

/**
 * таблица для тегов
 * Handles the creation of table `tag`.
 */
class m180425_050834_create_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tag', [
            'id' => $this->primaryKey(),
            //название тега по-русски
            'tag_name'=>$this->string()->unique(),
            'slug'=>$this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tag');
    }
}
