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
            $table->string('organisationName')->nullable();
            $table->string('procurementCategory')->nullable();
            $table->text('briefDescription')->nullable();
            $table->string('companyPhoneNumber')->nullable();
            $table->string('country')->nullable();
            $table->string('registrationNumber')->nullable();
            $table->string('taxId')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('zip_code')->nullable();
            $table->timestamps();
        });

        Schema::create('company_supplier', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Company::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Supply::class);
            $table->json('meta')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
