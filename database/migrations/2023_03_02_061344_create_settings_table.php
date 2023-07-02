<?php

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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_name')->nullable();
            $table->string('app_logo')->nullable();
            $table->string('select_ads')->nullable();
            $table->string('admob_app_id')->nullable();
            $table->string('admob_banner_id')->nullable();
            $table->string('admob_native_id')->nullable();
            $table->string('abmob_interstial_id')->nullable();
            $table->string('startio_app_id')->nullable();
            $table->string('applovin_app_id')->nullable();
            $table->string('applovin_banner_id')->nullable();
            $table->string('applovin_native_id')->nullable();
            $table->string('applovin_interstial_id')->nullable();
            $table->string('footer_text')->nullable();
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
        Schema::dropIfExists('settings');
    }
};
