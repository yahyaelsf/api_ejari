<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTRentRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_rent_requests', function (Blueprint $table) {
            $table->id('pk_i_id');
            $table->string('s_reference_number')->unique();
            $table->unsignedBigInteger('fk_i_category_id')->nullable();
            $table->unsignedBigInteger('fk_i_user_id')->nullable();
            $table->text('s_address')->nullable();
            $table->text('s_description')->nullable();
            $table->decimal('n_price', 12, 2)->nullable();
            $table->string('s_area')->nullable();
            $table->integer('n_family_members')->nullable();
            $table->integer('n_rooms')->nullable();
            $table->integer('n_bathrooms')->nullable();
            $table->integer('n_lounges')->nullable();
            $table->integer('s_floors')->nullable();
            $table->enum('e_furnished', ['Unfurnished', 'Semi-furnished', 'Furnished'])->default('Unfurnished');
            $table->enum('e_status' , ['new' ,'uses'])->default('uses');
            $table->enum('e_finishing_quality' , ['Deluxe' , 'Normal'])->default('Normal');
            $table->string('s_additional_features')->nullable();
            $table->string('s_surrounding_area')->nullable();
            $table->enum('e_water_conservation' , ['Government-project' , 'Community-project' , 'Whites'])->default('Government-project');
            $table->foreign('fk_i_category_id')->references('pk_i_id')->on('t_categories')->onDelete('set null');
            $table->foreign('fk_i_user_id')->references('pk_i_id')->on('t_users')->onDelete('cascade');
            $table->boolean('b_enabled')->default(0);
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
        Schema::dropIfExists('rent_requests');
    }
}
