<?php

use yii\db\Migration;

/**
 * Class m181019_133023_change
 */
class m181019_133023_change extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('users', 'user_email', 'email');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181019_133023_change cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181019_133023_change cannot be reverted.\n";

        return false;
    }
    */
}
