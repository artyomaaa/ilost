<?php

use yii\db\Migration;

/**
 * Handles the creation of table `finds`.
 */
class m181004_070401_create_finds_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('finds', [
            'id' => $this->primaryKey(),
            'country' => $this->string(),
            'city' => $this->string(),
            'address' => $this->string(),
            'data' => $this->string(),
            'title' => $this->string(),
            'text' => $this->text(),
            'img_kod' => $this->string(),
            'category' => $this->string(),
            'user_id' => $this->string(),
            'contact' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('finds');
    }
}
