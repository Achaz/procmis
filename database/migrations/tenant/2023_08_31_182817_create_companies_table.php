<?php

use App\Models\Company;
use App\Models\Supply;
use App\Models\User;
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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('category')->nullable();
            $table->text('description')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('tax_identification_number')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('zip_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
