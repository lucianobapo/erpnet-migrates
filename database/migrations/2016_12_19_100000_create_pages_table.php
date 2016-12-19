<?php

use ErpNET\Migrates\BaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends BaseMigration {

    protected $table = 'pages';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function upMigration()
    {
        $this->createTable(function (Blueprint $table) {
            $table->increments('id');

            /**
             * Relacionamentos entre as tabelas
             */
//            $table->integer('order_id')->unsigned()->index()->nullable();

            /**
             * Campos de data
             */
            $table->timestamps();
            $table->softDeletes();

            /**
             * Mandante do Banco de dados
             */
            $table->string('mandante')->index();

            // Campos
//            $table->timestamp('start_date')->default(DB::raw('CURRENT_TIMESTAMP'))->index();
//            $table->timestamp('end_date')->default(DB::raw('CURRENT_TIMESTAMP'))->index();

            $table->integer('ordem')->unsigned()->nullable();
            $table->string('rota')->nullable();
            $table->string('nome')->nullable();
            $table->string('h1')->nullable();
            $table->string('h2')->nullable();
            $table->string('view')->nullable();
            $table->text('conteudo')->nullable();
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
