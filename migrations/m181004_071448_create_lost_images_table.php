<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lost_images`.
 */
class m181004_071448_create_lost_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lost_images', [
            'id' => $this->primaryKey(),
            'image' => $this->string(),
            'lost_id' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lost_images');
    }
}
