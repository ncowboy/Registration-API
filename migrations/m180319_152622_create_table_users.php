<?php

use yii\db\Migration;

/**
 * Class m180319_152622_create_table_users
 */
class m180319_152622_create_table_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->createTable('users' , [
           'id' => $this->primaryKey(),
           'username' => $this->string(64)->unique()->notNull(),
           'password' => $this->string(64)->notNull(),
           'email' => $this->string(64)->unique(),
           'date_of_birth' => $this->date()
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropTable('users');
    }

}
