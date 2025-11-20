<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_notifications', function (Blueprint $table) {
            $table->id('pk_i_id');
            $table->morphs('notifiable');
            $table->string('e_type');
            $table->string('s_title');
            $table->string('s_message')->nullable();
            // $table->foreignIdFor(TUser::class, 'fk_i_sender_id')->nullable();
            $table->nullableMorphs('targetable');
            $table->integer('i_data_type')->nullable();
            $table->string('s_params')->nullable();
            $table->dateTime('dt_seen_date')->nullable()->default(null);
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
        Schema::dropIfExists('t_notifications');
    }
}
