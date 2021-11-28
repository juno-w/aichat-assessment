<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name');
            $table->date('start_date');
            $table->boolean('active')->default(1);
            $table->timestamps();
        });

        DB::table('campaigns')->insert([
            'uuid' => '8354e8fe-dac0-415c-8bd9-7e97b0fbc37b',
            'name' => 'Anniversary',
            'start_date' => '2021-11-01',
            'active' => 1,
            'created_at' => '2020-11-01 00:00:00',
            'updated_at' => '2020-11-01 00:00:00',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
