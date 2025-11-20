<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPropertySchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_property_schedules', function (Blueprint $table) {
            $table->id('pk_i_id');
            $table->unsignedBigInteger('fk_i_user_id');
            $table->unsignedBigInteger('fk_i_property_id');
            $table->foreign('fk_i_user_id')->references('pk_i_id')->on('t_users')->onDelete('cascade');
            $table->foreign('fk_i_property_id')->references('pk_i_id')->on('t_properties')->onDelete('cascade');
            $table->date('date');
            $table->time('from_time');
            $table->time('to_time');
            $table->enum('type',['multi_time','single_time'])->default('multi_time');
            $table->timestamp('dt_created_date')->nullable();
            $table->timestamp('dt_modified_date')->nullable();
            $table->timestamp('dt_deleted_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_property_schedules');
    }
}
