<?php

use yii\db\Migration;

/**
 * Связующая таблица между Авторами и новостями
 * Handles the creation of table `author_news`.
 * Has foreign keys to the tables:
 *
 * - `author`
 * - `news`
 */
class m180425_051239_create_junction_table_for_author_and_news_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('author_news', [
            'author_id' => $this->integer(),
            'news_id' => $this->integer(),
            'PRIMARY KEY(author_id, news_id)',
        ]);

        // creates index for column `author_id`
        $this->createIndex(
            'idx-author_news-author_id',
            'author_news',
            'author_id'
        );

        // add foreign key for table `author`
        $this->addForeignKey(
            'fk-author_news-author_id',
            'author_news',
            'author_id',
            'author',
            'id',
            'CASCADE'
        );

        // creates index for column `news_id`
        $this->createIndex(
            'idx-author_news-news_id',
            'author_news',
            'news_id'
        );

        // add foreign key for table `news`
        $this->addForeignKey(
            'fk-author_news-news_id',
            'author_news',
            'news_id',
            'news',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `author`
        $this->dropForeignKey(
            'fk-author_news-author_id',
            'author_news'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-author_news-author_id',
            'author_news'
        );

        // drops foreign key for table `news`
        $this->dropForeignKey(
            'fk-author_news-news_id',
            'author_news'
        );

        // drops index for column `news_id`
        $this->dropIndex(
            'idx-author_news-news_id',
            'author_news'
        );

        $this->dropTable('author_news');
    }
}
