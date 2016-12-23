<?php

use ErpNET\Migrates\BaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends BaseMigration {

    protected $table = 'posts';

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
            $table->integer('page_id')->unsigned()->index()->nullable();

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

            $table->string('title')->index();
            $table->string('titleSlug')->nullable()->index();
            $table->string('description')->nullable();
            $table->string('hint')->nullable();
            $table->string('paramProfileImageSize')->nullable();
//            $table->string('paramProfileImagePosition')->nullable();
            $table->string('paramProfileImageX')->nullable();
            $table->string('paramProfileImageY')->nullable();
            $table->string('paramName')->nullable();
            $table->string('paramFirstName')->nullable();
            $table->string('paramNameSize')->nullable();
            $table->string('paramNameColor')->nullable();
            $table->string('paramNameX')->nullable();
            $table->string('paramNameY')->nullable();
//            $table->string('titleSlug')->index();
            $table->string('file')->nullable();
            $table->string('file1')->nullable();
            $table->string('file2')->nullable();
            $table->string('file3')->nullable();
            $table->string('file4')->nullable();
            $table->string('file5')->nullable();
            $table->string('file6')->nullable();
            $table->string('file7')->nullable();
            $table->string('file8')->nullable();
            $table->string('file9')->nullable();
            $table->string('file10')->nullable();
            $table->string('file11')->nullable();
            $table->string('file12')->nullable();
            $table->string('file13')->nullable();
            $table->string('file14')->nullable();
            $table->string('file15')->nullable();
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
