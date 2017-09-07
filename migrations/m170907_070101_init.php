<?php

use yii\db\Schema;

class m170907_070101_init extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('seo_meta', [
            'id' => $this->primaryKey(),
            'route' => $this->string(200),
            'params' => $this->string(200),
            'title' => $this->string(255),
            'metakeys' => $this->string(255),
            'metadesc' => $this->string(255),
            'tags' => $this->text(),
            'h1' => $this->string(500)->notNull(),
            'robots' => $this->smallInteger(1)->notNull()->defaultValue(0),
            ], $tableOptions);
                

        $this->createIndex('idx_route', '{{%seo_meta}}', 'route', true);
        $this->createIndex('idx_params', '{{%seo_meta}}', 'params', true);

        $this->insert('{{%seo_meta}}', [
            'route'    => '-',
            'title'    => 'Domyślny tytuł',
            'metakeys' => '',
            'metadesc' => '',
            'tags'     => json_encode(['og:type' => 'website', 'og:url' => '%CANONICAL_URL%', 'og:image' => '/og-image.jpg']),
            'robots'   => 0
        ]);


    }

    public function down()
    {
        $this->dropTable('seo_meta');
    }
}
