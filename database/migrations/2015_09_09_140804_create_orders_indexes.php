<?php

use ErpNET\Migrates\BaseMigration;

class CreateOrdersIndexes extends BaseMigration
{
    protected $table = 'orders';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function upMigration()
    {
        $this->createIndex('deleted_at');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function downMigration()
    {
        $this->dropIndex('deleted_at');
    }
}
