<?php

use yii\db\Migration;

/**
 * Handles the creation of table `find_images`.
 */
class m181004_071511_create_find_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('find_images', [
            'id' => $this->primaryKey(),
            'image' => $this->string(),
            'find_id' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('find_images');
    }
}
