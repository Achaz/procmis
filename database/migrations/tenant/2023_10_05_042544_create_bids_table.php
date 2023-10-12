<?php
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
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('procurementplan')->nullable();
            $table->string('procurementsubject')->nullable();
            $table->string('referenceNumber')->nullable();
            $table->string('procurementtype')->nullable();
            $table->text('summary')->nullable();
            $table->string('submissiondeadline')->nullable();
            $table->string('documents')->nullable();
            $table->string('displayperiod')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('bids');
    }
};
