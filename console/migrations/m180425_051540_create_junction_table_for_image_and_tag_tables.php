<?php

use yii\db\Migration;

/**
 * Таблица связи между изображениями и тегами
 * Handles the creation of table `image_tag`.
 * Has foreign keys to the tables:
 *
 * - `image`
 * - `tag`
 */
class m180425_051540_create_junction_table_for_image_and_tag_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('image_tag', [
            'image_id' => $this->integer(),
            'tag_id' => $this->integer(),
            'PRIMARY KEY(image_id, tag_id)',
        ]);

        // creates index for column `image_id`
        $this->createIndex(
            'idx-image_tag-image_id',
            'image_tag',
            'image_id'
        );

        // add foreign key for table `image`
        $this->addForeignKey(
            'fk-image_tag-image_id',
            'image_tag',
            'image_id',
            'image',
            'id',
            'CASCADE'
        );

        // creates index for column `tag_id`
        $this->createIndex(
            'idx-image_tag-tag_id',
            'image_tag',
            'tag_id'
        );

        // add foreign key for table `tag`
        $this->addForeignKey(
            'fk-image_tag-tag_id',
            'image_tag',
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
        // drops foreign key for table `image`
        $this->dropForeignKey(
            'fk-image_tag-image_id',
            'image_tag'
        );

        // drops index for column `image_id`
        $this->dropIndex(
            'idx-image_tag-image_id',
            'image_tag'
        );

        // drops foreign key for table `tag`
        $this->dropForeignKey(
            'fk-image_tag-tag_id',
            'image_tag'
        );

        // drops index for column `tag_id`
        $this->dropIndex(
            'idx-image_tag-tag_id',
            'image_tag'
        );

        $this->dropTable('image_tag');
    }
}
