<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->string('user_id')->after('name')->nullable();
            $table->string('email')->after('user_id')->nullable();
            $table->string('phone')->after('email')->nullable();
            $table->string('address')->after('phone')->nullable();
            $table->string('city')->after('address')->nullable();
            $table->string('state')->after('city')->nullable();
            $table->string('zipcode')->after('state')->nullable();
            $table->string('country')->after('zipcode')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('zipcode');
            $table->dropColumn('country');
        });
    }
};
