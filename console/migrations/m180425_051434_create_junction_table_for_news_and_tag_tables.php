<?php

use yii\db\Migration;

/**
 * Таблица связи между новостями и тегами
 * Handles the creation of table `news_tag`.
 * Has foreign keys to the tables:
 *
 * - `news`
 * - `tag`
 */
class m180425_051434_create_junction_table_for_news_and_tag_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('news_tag', [
            'news_id' => $this->integer(),
            'tag_id' => $this->integer(),
            'PRIMARY KEY(news_id, tag_id)',
        ]);

        // creates index for column `news_id`
        $this->createIndex(
            'idx-news_tag-news_id',
            'news_tag',
            'news_id'
        );

        // add foreign key for table `news`
        $this->addForeignKey(
            'fk-news_tag-news_id',
            'news_tag',
            'news_id',
            'news',
            'id',
            'CASCADE'
        );

        // creates index for column `tag_id`
        $this->createIndex(
            'idx-news_tag-tag_id',
            'news_tag',
            'tag_id'
        );

        // add foreign key for table `tag`
        $this->addForeignKey(
            'fk-news_tag-tag_id',
            'news_tag',
            'tag_id',
            'tag',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `news`
        $this->dropForeignKey(
            'fk-news_tag-news_id',
            'news_tag'
        );

        // drops index for column `news_id`
        $this->dropIndex(
            'idx-news_tag-news_id',
            'news_tag'
        );

        // drops foreign key for table `tag`
        $this->dropForeignKey(
            'fk-news_tag-tag_id',
            'news_tag'
        );

        // drops index for column `tag_id`
        $this->dropIndex(
            'idx-news_tag-tag_id',
            'news_tag'
        );

        $this->dropTable('news_tag');
    }
}
