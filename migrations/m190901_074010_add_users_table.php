<?php

use yii\db\Migration;

/**
 * Class m190901_074010_add_users_table
 */
class m190901_074010_add_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $tableOptions = null;

        if ($this->db->driverName === 'mysql')
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable("users",
            [
                'id' => $this->primaryKey(),
                'full_name' => $this->string()->notNull(),
                'username' => $this->string()->notNull()->unique(),
                'email' => $this->string()->notNull(),
                'password' => $this->string()->notNull(),
                'avatar_id' => $this->string(),
                'role_id' => $this->integer()->notNull(),
                'status' => $this->smallInteger()->notNull(),
                'auth_key' => $this->string(32)->notNull(),
                'access_token' => $this->string(250)->null(),
                'password_reset_token' => $this->string()->unique(),
                'account_activation_token' => $this->string(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ],$tableOptions);

        $this->delete("users", ['id' => '1']);

        $this->insert("users", [
            'id'                        =>  '1',
            'full_name'                        =>  'Sadam Hussain',
            'username'                  =>  'admin',
            'email'                     =>  "dsbsadam@gmail.com",
            'password'             =>  md5("admin"),
            'avatar_id'             =>  1,
            'role_id'             =>  1,
            'status'                    =>  1,
            'auth_key'                  =>  '',
            'access_token'              =>  NULL,
            'password_reset_token'      =>  NULL,
            'account_activation_token'  =>  NULL,
            'created_at'                =>  2019,
            'updated_at'                =>  2019,
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
