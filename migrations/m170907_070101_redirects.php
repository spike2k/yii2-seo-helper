<?php

use yii\db\Schema;

class m170907_070101_redirects extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('seo_redirects', [
            'id' => $this->primaryKey(),
            'old_url' => $this->string(255)->notNull(),
            'new_url' => $this->string(255)->notNull()->defaultValue('/'),
            'status' => $this->string()->notNull()->defaultValue('301'),
            ], $tableOptions);
        $this->createIndex('idx_old_url', '{{%seo_redirects}}', 'old_url', true);
                
    }

    public function down()
    {
        $this->dropTable('seo_redirects');
    }
}
