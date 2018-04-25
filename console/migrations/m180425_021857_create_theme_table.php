<?php

use yii\db\Migration;

/**
 * Миграция темы новостей, или раздела,
 * в кажом из которых может быть несколько рубрик
 * с новостями
 * Handles the creation of table `theme`.
 */
class m180425_021857_create_theme_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('theme', [
            'id' => $this->primaryKey(),
            'slug'=>$this->string(100)->unique()->notNull(),

            //Название темы по-русски, напр. "Политика",
            //"Культура" итд
            'theme_title'=>$this->string(100)->unique()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('theme');
    }
}
