<?php

use Illuminate\Database\Schema\Blueprint;
use ErpNET\Migrates\BaseMigration;

class CreatePasswordResetsTable extends BaseMigration
{
    protected $table = 'password_resets';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function upMigration()
    {
        $this->createTable(function(Blueprint $table){
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function downMigration()
    {
        $this->dropTable();
    }
}
