<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m191114_105231_kadastr_table
 */
class m191114_105231_kadastr_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        //таблица kadastr
        $this->createTable('{{%kadastr}}', [
            'id' => Schema::TYPE_PK,
            'cadastral_number' => Schema::TYPE_STRING . '(100) NOT NULL',
            'address' => Schema::TYPE_TEXT . ' NOT NULL',
            'price' => Schema::TYPE_DOUBLE . ' NOT NULL',
            'area' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       // echo "m191114_105231_kadastr_table cannot be reverted.\n";

        $this->dropTable('{{%kadastr}}');

        //return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191114_105231_kadastr_table cannot be reverted.\n";

        return false;
    }
    */
}
