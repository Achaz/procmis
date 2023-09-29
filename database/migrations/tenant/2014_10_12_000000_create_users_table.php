<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Company;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->json('meta')->nullable();
            $table->foreignIdFor(User::class)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('company_users', function (Blueprint $table) {
           $table->foreignIdFor(Company::class);
           $table->foreignIdFor(User::class);
           $table->enum("status",[1,2,3,4,5,0])->default(0);
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('company_users');
    }
};
