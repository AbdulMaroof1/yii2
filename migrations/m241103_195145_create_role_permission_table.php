<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%role_permission}}`.
 */
class m241103_195145_create_role_permission_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Create the role_permission table
        $this->createTable('{{%role_permission}}', [
            'id' => $this->primaryKey(),
            'role_id' => $this->integer()->notNull(),
            'permission_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultValue(null),
            'updated_at' => $this->timestamp()->defaultValue(null),
        ]);
        
        // Add foreign key for role_id
        $this->addForeignKey(
            'fk-role_permission-role_id',
            '{{%role_permission}}',
            'role_id',
            '{{%roles}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Add foreign key for permission_id
        $this->addForeignKey(
            'fk-role_permission-permission_id',
            '{{%role_permission}}',
            'permission_id',
            '{{%permissions}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop foreign keys first
        $this->dropForeignKey('fk-role_permission-role_id', '{{%role_permission}}');
        $this->dropForeignKey('fk-role_permission-permission_id', '{{%role_permission}}');

        // Drop the role_permission table
        $this->dropTable('{{%role_permission}}');
    }
}
