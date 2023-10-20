<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m181004_071325_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'email' => $this->string(),
            'contact_number' => $this->string(),
            'password' => $this->string(),
            'verify' => $this->string(),
            'token' => $this->string(),
        ]);
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');

    }
}
