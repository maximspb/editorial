<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m180425_025142_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'title'=> $this->string(100)->notNull(),
            'lead'=> $this->string(200)->notNull(),
            'text'=>$this->text()->notNull(),
            'image_id'=>$this->integer(),
            'theme_id'=>$this->integer(),
            'rubric_id'=>$this->integer(),
            'user_id'=>$this->integer(),
            'created_at' => $this->timestamp()->defaultValue(null),
            'updated_at' => $this->timestamp()->defaultValue(null),
            'slug'=>$this->string(150)->unique()
        ]);

        //связь с таблицей изображений
        $this->addForeignKey(
            'fk_news_image_id',
            'news',
            'image_id',
            'image',
            'id',
            'SET NULL',
            'NO ACTION'

        );
        
        //Связь с таблицей главных разделов
        $this->addForeignKey(
            'fk_news_theme_id',
            'news',
            'theme_id',
            'theme',
            'id',
            'SET NULL',
            'CASCADE'

        );

        //Связь с рубрикой
        $this->addForeignKey(
            'fk_news_rubric_id',
            'news',
            'rubric_id',
            'rubric',
            'id',
            'SET NULL',
            'CASCADE'

        );

        //связь с юзером
        $this->addForeignKey(
            'fk_news_user_id',
            'news',
            'user_id',
            'user',
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
        $this->dropTable('news');
    }
}
