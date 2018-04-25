<?php

use yii\db\Migration;

/**
 *таблица модели "Автор" - в данном случае
 *это не обязательно тот, кто добавляет новость, а автор
 *применительно к сфере СМИ, т.е. автор самого
 *текста, если речь идет о каких-то развернутых
 * публикациях. например, если это автор какой-то
 * постоянной колонки на сайте.
 * Handles the creation of table `author`.
 */
class m180425_023115_create_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('author', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(100)->notNull(),
            'email'=>$this->string(100)->unique(),
            'slug' =>$this->string(100)->unique()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('author');
    }
}
