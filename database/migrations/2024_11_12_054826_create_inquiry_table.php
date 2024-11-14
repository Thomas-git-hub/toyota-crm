<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inquiry', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->string('customer_first_name');
            $table->string('customer_last_name');
            $table->string('contact_number');
            $table->string('unit');
            $table->string('variant');
            $table->string('color');
            $table->string('transaction');
            $table->string('gender');
            $table->integer('age');
            $table->string('source');
            $table->unsignedBigInteger('province_id');
            $table->longText('remarks')->nullable();
            $table->string('date')->nullable(); //monthname day
            $table->string('transactional_status')->default('pending');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('province_id')->references('id')->on('province');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiry');
    }
};
