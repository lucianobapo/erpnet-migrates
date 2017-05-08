<?php

use ErpNET\Migrates\BaseMigration;
use Illuminate\Database\Schema\Blueprint;

class AlterUsersTable extends BaseMigration {

    protected $table = 'users';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function upMigration()
    {
        $this->alterTable(function (Blueprint $table) {
            $table->string('braintree_id')->nullable();
            $table->string('paypal_email')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('card_last_four')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function downMigration()
    {
        $this->dropColumn('braintree_id');
        $this->dropColumn('paypal_email');
        $this->dropColumn('card_brand');
        $this->dropColumn('card_last_four');
        $this->dropColumn('trial_ends_at');
    }
}
