<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('code', 255);
            $table->integer('status')->default(1);
            $table->integer('admin_id');
            $table->datetime('date_from')->nullable();
            $table->datetime('date_to');
            $table->bigInteger('price');
            $table->string('country', 255);
            $table->string('email', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('customer_title', 255)->nullable();
            $table->string('customer_first_name', 255)->nullable();
            $table->string('customer_last_name', 255)->nullable();
            $table->text('description')->nullable();
            $table->integer('amount_customer')->default(1);
            $table->string('budget_person', 255)->nullable(1);
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
        Schema::dropIfExists('bookings');
    }
}
