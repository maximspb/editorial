<?php

use yii\db\Migration;

/**
 * Handles adding created_at to table `image`.
 */
class m180503_173001_add_created_at_column_to_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('image', 'created_at', $this->timestamp()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
