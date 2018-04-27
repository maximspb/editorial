<?php

use yii\db\Migration;

/**
 * Handles adding publish to table `news`.
 */
class m180427_034812_add_publish_column_to_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('news', 'publish', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('news', 'publish');
    }
}
