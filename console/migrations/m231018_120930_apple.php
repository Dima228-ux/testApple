<?php

use yii\db\Migration;

/**
 * Class m231018_120930_apple
 */
class m231018_120930_apple extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%apple}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string(255),
            'date_appearance' => $this->string(255),
            'date_fall' => $this->string(255),
            'status' => $this->boolean(),
            'percent_eat'=>$this->integer(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apple}}');
    }
}
