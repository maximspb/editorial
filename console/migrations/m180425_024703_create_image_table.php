<?php

use yii\db\Migration;

/**
 * Handles the creation of table `image`.
 */
class m180425_024703_create_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('image', [
            'id' => $this->primaryKey(),
            'filename'=>$this->string()->unique(),
            'alt'=>$this->string()->defaultValue(null),

            //Источник изображения, т.е. откуда оно было взято:
            'source'=>$this->string()->defaultValue('Соцсети'),
            'created_at'=>$this->timestamp()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('image');
    }
}
