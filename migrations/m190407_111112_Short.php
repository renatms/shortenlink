<?php

use yii\db\Migration;

/**
 * Class m190407_111112_Short
 */
class m190407_111112_Short extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('short', [
            'id' => $this->primaryKey(),
            'url' => $this->string(300)->notNull(),
            'short_key' => $this->string(10)->notNull(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190407_111112_Short cannot be reverted.\n";

        $this->dropTable('short');
    }

}
