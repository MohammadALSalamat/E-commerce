<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PincodeMalaysia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('pincodes', function (Blueprint $table) {
            $table->id();
            $table->string('ISO');
            $table->string('Country');
            $table->string('Language');
            $table->string('Region 1');
            $table->string('Region 2');
            $table->string('Region 3');
            $table->string('Region 4');
            $table->string('Locality');
            $table->string('Postcode');
            $table->string('Suburb');
            $table->string('Street');
            $table->string('Range');
            $table->string('Building');
            $table->string('Latitude');
            $table->string('Longitude');
            $table->string('Elevation');
            $table->string('ISO2');
            $table->string('FIPS');
            $table->string('NUTS');
            $table->string('HASC');
            $table->string('STAT');
            $table->string('Timezone');
            $table->string('UTC');
            $table->string('DST');
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
        //
    }
}
