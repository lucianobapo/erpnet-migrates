<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateAutomatedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tablesSchema = config('erpnetMigrates.tablesSchema');
        //validação do array de tabelas
        if (!(is_array($tablesSchema) && count($tablesSchema)>0))
            abort(403, 'Array de Tabelas inconsistente');

        foreach ($tablesSchema as $tableName => $fields) {
            //validação do array de campos
            if (!(is_array($fields) && count($fields)>0))
                abort(403, 'Array de Campos da tabela "'.$tableName.'" inconsistente');

            $this->createTable($tableName, $fields);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tablesSchema = config('erpnetMigrates.tablesSchema');
        //validação do array de tabelas
        if (!(is_array($tablesSchema) && count($tablesSchema)>0))
            abort(403, 'Array de Tabelas inconsistente');

        foreach ($tablesSchema as $tableName => $fields) {
            //validação do array de campos
            if (!(is_array($fields) && count($fields)>0))
                abort(403, 'Array de Campos da tabela "'.$tableName.'" inconsistente');

            $this->dropTable($tableName);
        }

    }

    private function createTable($tableName, $fields)
    {
        Schema::create($tableName, function(Blueprint $table) use($fields)
        {
            if (isset($fields['tableAttributes']) && isset($fields['tableFields'])) {
                $this->createTableAttributes($table, $fields['tableAttributes']);
                $this->createTableFields($table, $fields['tableFields']);
            }
            else $this->createTableFields($table, $fields);

        });
        if (config('app.env')!='testing') echo get_class($this).": Table ".$tableName." is up\n";

//        if(env('ERPNET_MIGRATES_FORCE', false) || isset(config('erpnetMigrates.tables')[$this->table])){
//            if(is_null($this->connection)) $this->connection = Schema::connection(config('database.default'));
//            $this->upMigration();
//            if (config('app.env')!='testing') echo get_class($this)." is up\n";
//        } elseif (config('app.env')!='testing') {
//            echo $this->table." not configured\n";
//        }
    }

    private function dropTable($tableName)
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists($tableName);

        Schema::enableForeignKeyConstraints();

        if (config('app.env')!='testing') echo get_class($this).": Table ".$tableName." is down\n";
    }

    private function createTableFields(Blueprint $table, array $fields)
    {
        foreach ($fields as $fieldName => $fieldParams) {
            //Se for string cria campo padrão
            if(is_string($fieldParams))
                $table->string($fieldParams);

            //Se for array analisa os parametros
            if(is_array($fieldParams) && isset($fieldParams['fieldType']))
                if (method_exists($table, $fieldParams['fieldType']) && is_callable([$table, $fieldParams['fieldType']])){
                    $resolvedFieldName = isset($fieldParams['fieldName'])?$fieldParams['fieldName']:$fieldName;
                    $tableFunc = call_user_func([$table, $fieldParams['fieldType']], $resolvedFieldName);

                    //Verifica os modifiers do campo
                    if(isset($fieldParams['fieldModifiers']) && is_array($fieldParams['fieldModifiers']) && count($fieldParams['fieldModifiers'])>0)
                        foreach ($fieldParams['fieldModifiers'] as $fieldModifierKey => $fieldModifierValue) {
                            if (is_string($fieldModifierValue) && is_callable([$tableFunc, $fieldModifierValue]))
                                call_user_func([$tableFunc, $fieldModifierValue]);

                            if (is_array($fieldModifierValue) && count($fieldModifierValue)==1 && is_callable([$tableFunc, $fieldModifierKey]))
                                call_user_func([$tableFunc, $fieldModifierKey], $fieldModifierValue[0]);
                        }
                }

        }
    }

    private function createTableAttributes(Blueprint $table, array $tableAttributes)
    {
        foreach ($tableAttributes as $attributeKey => $attributeValue) {
            //Se for string cria atributo sem parametros
            if(is_string($attributeValue))
                if (method_exists($table, $attributeValue) && is_callable([$table, $attributeValue]))
                    call_user_func([$table, $attributeValue]);

            //Se for array analisa os parametros
            if(is_array($attributeValue) && count($attributeValue)==1)
                if (method_exists($table, $attributeKey) && is_callable([$table, $attributeKey]))
                    call_user_func([$table, $attributeKey], $attributeValue[0]);
        }
    }
}
