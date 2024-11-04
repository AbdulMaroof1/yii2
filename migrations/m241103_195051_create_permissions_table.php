<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%permissions}}`.
 */
class m241103_195051_create_permissions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Create the permissions table
        $this->createTable('{{%permissions}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'created_at' => $this->timestamp()->defaultValue(null),
            'updated_at' => $this->timestamp()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop the permissions table
        $this->dropTable('{{%permissions}}');
    }
}
