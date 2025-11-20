<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_favorites', function (Blueprint $table) {
            $table->id('pk_i_id');
            $table->unsignedBigInteger('fk_i_user_id');
            $table->unsignedBigInteger('fk_i_property_id');
            $table->foreign('fk_i_user_id')->references('pk_i_id')->on('t_users')->onDelete('cascade');
            $table->foreign('fk_i_property_id')->references('pk_i_id')->on('t_properties')->onDelete('cascade');
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
        Schema::dropIfExists('t_favorites');
    }
}
