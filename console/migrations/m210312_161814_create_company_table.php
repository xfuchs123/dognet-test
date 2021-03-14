<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company}}`.
 */
class m210312_161814_create_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'country' => $this->string(255),
            'vat_id' => $this->string(40),
            'fk_user' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-company-user',
            '{{%company}}',
            'fk_user'
        );

        $this->addForeignKey(
            'fk-company-user',
            '{{%company}}',
            'fk_user',
            '{{%user}}',
             'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_company-user','{{%company}}');
        $this->dropIndex('idx-company-user','{{%company}}');
        $this->dropTable('{{%company}}');
    }
}
