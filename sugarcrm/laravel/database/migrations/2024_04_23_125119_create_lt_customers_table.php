<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLtCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lt_customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 55);
            $table->string( 'last_name', 55);
            $table->string( 'id_number', 15);
            $table->string( 'phone', 15)->nullable();
            $table->string( 'id_number_status', 9)->nullable();
            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('lt_customers');
    }
}
